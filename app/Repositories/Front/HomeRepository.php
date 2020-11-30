<?php



namespace App\Repositories\Front;

use App\Models\Product;
use App\Models\Category;
use App\Interfaces\Front\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{

    public $product; // modal

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
            'images' => function ($im) {
                return $im->select(['name', 'product_id']);
            }
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
        return $this->product->active()->with(
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
                }

            ]
        )->active()->latest()->limit(18)->get();
    }

    //----------------get  products best sellers---------


    public function getBestSellers($limit)
    {
        return $this->product->active()->with(
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
                    ]);
                }

            ]
        )->active()->latest()->limit(18)->get();
    }

    //----------------get  products trending---------


    public function getProductsTrending($limit)
    {
        return $this->product->active()->with(
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
                    ]);
                }

            ]
        )->active()->latest()->limit(18)->get();
    }



    //------------------get 3 main categories wsi his chields products ----


    public function getThreeMainCategoriesWithChieldsProducts(int $chields_count = 3,int $products_count = 4)
    {
        $categories = Category::mainCategory()
            ->active()
            ->whereHas('chields', function ($chi) {
                return $chi->whereHas('products');
            })
            ->with(['chields'])
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($main) use($chields_count) {
                $main->setRelation('chields', $main->chields->take($chields_count) ); // limit of chields
                return $main;
            });


        $groups = [];

        foreach ($categories as $key => $main_categories) {

            foreach ($main_categories->chields as $subcategory) {
                if ($subcategory->products->count() > 0) { // if not fund name translation
                    $groups[$key]['name'] = $main_categories->name;

                    //------ add limit of products get in chiled
                    foreach ($subcategory->products()->active()->with('attribute')->whereHas('attribute')->latest()->take($products_count)->get() as $product) {

                        $groups[$key]['products'][] = $product;
                    }
                }
            }
        }



        return   collect($groups);


    }




    //--------------------------------------





}
