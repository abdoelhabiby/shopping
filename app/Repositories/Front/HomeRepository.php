<?php



namespace App\Repositories\Front;

use App\Interfaces\Front\HomeRepositoryInterface;
use App\Models\Product;

class HomeRepository implements HomeRepositoryInterface
{

    protected $product;

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
                'vendor' => function($vend){
                    return $vend->select(['name','id']);
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
                    ])->where('is_active',true);
                }

            ]
        )->active()->latest()->limit(18)->get();
    }


    //--------------------------------------


}
