<?php



namespace App\Repositories\Front;

use App\Models\Product;
use App\Models\Category;
use App\Interfaces\Front\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{

    public $product; // model

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    //-------------method to get some offers----------------
    public function getProductsOffer($limit)
    {

        return $this->product->active()->whereHas('offer')->with([
            'offer' => function ($offer) {
                return $offer->select([
                    "id",
                    "sku",
                    "qty",
                    "product_id",
                    "price",
                    "price_offer",
                    "start_offer_at",
                    "end_offer_at",
                ]);
            },
            'images',
            'reviewsRating'
        ])
            ->limit($limit)->get()->map(function ($album) {
                $album->setRelation('images', $album->images->take(2));
                return $album;
            });
    }


    //--------------------------------------

    //----------------get new products---------

    public function getNewProducts($limit)
    {
        return  $this->product->active()

            ->with(
                [
                    'vendor' => function ($vend) {
                        return $vend->select(['name', 'id']);
                    },
                    'attribute' => function ($attr) {
                        return $attr->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                            "is_active",
                            "price",
                            "price_offer",
                            "start_offer_at",
                            "end_offer_at",
                        ])->where('is_active', true);
                    },
                    'images',
                    'reviewsRating'

                ]
            )->active()->latest()->limit($limit)->get()->map(function ($product) {
                $product->setRelation('images', $product->images->take(2));
                return $product;
            });
    }

    //----------------get  products best sellers---------


    public function getBestSellers($limit)
    {
        return $this->product->active()

            ->with(
                [
                    'vendor' => function ($vend) {
                        return $vend->select(['name', 'id']);
                    },
                    'attribute' => function ($attr) {
                        return $attr->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                            "is_active",
                            "price",
                            "price_offer",
                            "start_offer_at",
                            "end_offer_at",
                        ])->where('is_active', true);
                    },
                    'images',
                    'reviewsRating'

                ]
            )->latest()->limit($limit)->get()->map(function ($product) {
                $product->setRelation('images', $product->images->take(2));
                return $product;
            });
    }

    //----------------get  products trending---------


    public function getProductsTrending($limit)
    {
        return $this->product->active()
            ->with(
                [
                    'vendor' => function ($vend) {
                        return $vend->select(['name', 'id']);
                    },
                    'attribute' => function ($attr) {
                        return $attr->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                            "is_active",
                            "price",
                            "price_offer",
                            "start_offer_at",
                            "end_offer_at",
                        ])->where('is_active', true);
                    },
                    'images',
                    'reviewsRating'


                ]
            )->latest()->limit($limit)->get()->map(function ($product) {
                $product->setRelation('images', $product->images->take(2));
                return $product;
            });
    }



    //------------------get 3 main categories wsi his chields with products products ----


    public function getMainCategoriesWithNestedSubcategoriesProducts(int $main_categories_limit = 3, int $products_limit = 10,int $image_count = 2)
    {

        $category = Category::mainCategory()
            ->whereHas('chields.chields')
            ->with([
                'chields' => function ($query) {
                    $query->active()->select(['id', 'parent_id', 'slug']);
                },
                'chields.chields' => function ($query) {
                    $query->active()->select(['id', 'parent_id', 'slug'])->whereHas('products.attributes');
                }
            ])
            ->select(['id', 'parent_id', 'slug'])
            ->inRandomOrder()
            ->active()
            ->limit($main_categories_limit)->get();


        $main_category_with_las_chields_id = $category->mapWithKeys(function ($main) {
            return [$main->slug => $main->chields->map(function ($lastchield) {
                return  $lastchield->chields->map(function ($map) {
                    return  $map->id;
                });
            })->collapse()];
        })->toArray();

        $ids = $main_category_with_las_chields_id['clothes'];

        $category_products = [];

        foreach ($main_category_with_las_chields_id as $category => $chields_id) {
            if ($category && is_array($chields_id) && count($chields_id) > 0) {

                $category_products[$category] = Product::whereHas('categories', function ($query) use ($chields_id) {
                    $query->whereIn('product_categories.category_id', $chields_id);
                })
                    ->with([
                        'categories' => function ($query) use ($chields_id) {
                            $query->whereIn('product_categories.category_id', $chields_id);
                        },
                        'vendor' => function ($vend) {
                            return $vend->select(['name', 'id']);
                        },
                        'attribute' => function ($attr) {
                            return $attr->where('is_active', true);
                        },
                        'images',
                        'reviewsRating'
                    ])
                    ->active()
                    ->orderBy('created_at', 'desc')
                    ->limit($products_limit)
                    ->get()->map(function ($product) use($image_count) {
                        $product->setRelation('images', $product->images->take($image_count));
                        return $product;
                    });
            }
        }

        return  $category_products;
    }


    // --------------------------------------------






}
