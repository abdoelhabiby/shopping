<?php



namespace App\Repositories\Front;

use App\Contracts\Front\HomeIndexContract;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class HomeIndexRepository implements HomeIndexContract
{

    public $product; // model

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    //-------------method to get some offers----------------
    public function getProductsOffer($limit)
    {

        $ttl = 60 * 60 * 6; //evry 6 hours


        // $products_offer = Cache::remember('home_products_offer', $ttl, function () use ($limit) {

        $products_offer = $this->product->active()->whereHas('offer')->with([
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
                ])->active()->withTranslation();
            },
            'images' => function ($query) {
                $query->orderBy('id', 'asc')->take(2);
            },
            'reviewsRating'
        ])
            ->withTranslation()
            ->limit($limit)->get();
        // });


        return $products_offer;
    }


    //--------------------------------------

    //----------------get new products---------

    public function getNewProducts($limit)
    {

        $ttl = 60 * 60 * 3; //evry 3 hours

        // $new_products = Cache::remember('home_new_products', $ttl, function () use ($limit) {

        $new_products =  $this->product->active()
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
                        ])->active()->withTranslation();
                    },
                    'images' => function ($query) {
                        $query->orderBy('id', 'asc')->take(2);
                    },
                    'reviewsRating'

                ]
            )
            ->withTranslation()
            ->active()->latest()->limit($limit)->get();
        // });

        return  $new_products;
    }

    //----------------get  products best sellers---------


    public function getBestSellers($limit)
    {
        $ttl = 60 * 60 * 4; //evry 4 hours

        // $products_best_seller = Cache::remember('home_products_best_seller', $ttl, function () use ($limit) {

        $products_best_seller = $this->product->leftJoin('order_products', 'products.id', '=', 'order_products.product_id')
            ->selectRaw('products.*, IFNULL(SUM(order_products.quantity),0) AS `quantity`')
            ->active()
            ->whereHas('attribute', function ($attribute) {
                return $attribute->active();
            })

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
                        ])->where('is_active', true)->withTranslation();
                    },
                    'images' => function ($query) {
                        $query->orderBy('id', 'asc')->take(2);
                    },
                    'reviewsRating'

                ]
            )
            ->withTranslation()
            ->groupBy('products.id')
            ->orderBy('quantity', 'desc')
            ->limit($limit)
            ->get();
        // });

        return $products_best_seller;
    }

    //----------------get  products trending---------


    public function getProductsTrending($limit)
    {
        $ttl = 60 * 60 * 4; //evry 4 hours

        // $products_trending = Cache::remember('home_products_trending', $ttl, function () use ($limit) {


        $products_trending =  $this->product->active()

            ->with(
                [
                    'vendor:id,name',
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
                        ])->where('is_active', true)->withTranslation();
                    },
                    'images' => function ($query) {
                        $query->orderBy('id', 'asc')->take(2);
                    },
                    'reviewsRating'


                ]
            )
            ->withTranslation()
            ->latest()->limit($limit)->get();
        // });

        return $products_trending;
    }



    //------------------get 3 main categories wsi his chields with products products ----


    public function getMainCategoriesWithNestedSubcategoriesProducts(int $main_categories_limit = 3, int $products_limit = 10, int $image_count = 2)
    {





        // $ttl = 60 * 60 * 4; //evry 4 hours

        // $main_category_with_nested_chields_products = Cache::remember('home_main_category_with_nested_chields_products', $ttl, function () use ($main_categories_limit, $products_limit, $image_count) {

        $main_categories =  Category::mainCategory()
            ->whereHas('subCategories', function ($q) {
                $q->whereHas('categories', function ($category) {
                    $category->where('is_active', true)->whereHas('products', function ($q) {
                        $q->active();
                    });
                });
            })
            ->with(['subCategories' => function ($query) {
                $query->whereHas('categories', function ($category) {
                    $category->where('is_active', true)->whereHas('products', function ($q) {
                        $q->active();
                    });
                })
                    ->with('categories:id,parent_id,slug')
                    ->select(['parent_id', 'slug', 'id']);
            }])
            ->select(['id', 'parent_id', 'slug'])
            ->inRandomOrder()
            ->withTranslation()
            ->active()
            ->limit($main_categories_limit)
            ->get();



        $main_category_with_las_chields_id = $main_categories->mapWithKeys(function ($main) {
            return [
                $main->slug => [
                    'categories' =>  $main->subCategories->map(function ($lastchield) {
                        return  $lastchield->categories->map(function ($map) {
                            return  $map->id;
                        });
                    })->collapse(), 'category_translations' => $main->translations->pluck('name', 'locale')->toArray()
                ]
            ];
        })->toArray();


        $category_products = [];

        foreach ($main_category_with_las_chields_id as $category => $data) {


            $chields_id = $data['categories']->toArray(); //ids category has products relation


            if ($category && is_array($chields_id) && count($chields_id) > 0) {


                $products = Product::whereHas('categories', function ($query) use ($chields_id) {
                    $query->whereIn('product_categories.category_id', $chields_id);
                })
                    ->with([

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
                            ])->where('is_active', true)->withTranslation();
                        },
                        'images' => function ($query) {
                            $query->orderBy('id', 'asc')->take(2);
                        },
                        'reviewsRating'
                    ])
                    ->active()
                    ->orderBy('created_at', 'desc')
                    ->limit($products_limit)
                    ->withTranslation()
                    ->get();

                $category_products[$category]['products'] = $products;

                $category_products[$category]['category_translations'] = $data['category_translations'] ?? $category;
            }
        }


        return  $category_products;



        // }); // end cache


        // return $main_category_with_nested_chields_products;
    }


    // --------------------------------------------






}
