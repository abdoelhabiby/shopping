<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Front\BaseController;

class ProductController extends BaseController
{





    //----------------------------------------------------------
    public function show($product_slug, $product_attribute_id)
    {

        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id) {
                return $attribute->where('id', $product_attribute_id)
                    ->where('is_active', true);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('is_active', true)->where('id', $product_attribute_id)
                        ->select([
                            "sku",
                            "qty",
                            "product_id",
                            "is_active",
                            "price",
                            "price_offer",
                            "start_offer_at",
                            "end_offer_at",
                            "id",
                        ]);
                },
                'attributes' => function ($at) {
                    return $at->where('is_active', true)->select([
                        "sku",
                        "qty",
                        "product_id",
                        "is_active",
                        "price",
                        "price_offer",
                        "start_offer_at",
                        "end_offer_at",
                        "id",

                    ]);
                },

                'categories' => function ($cat) {
                    return $cat->select(['product_id', 'category_id', 'categories.id']);
                },
                'tags' => function ($tag) {
                    return $tag->select(['product_id', 'tag_id', 'tags.id']);
                },
                'brand'  => function ($brand) {
                    return $brand->where('is_active', true)->select(['id', 'slug']);
                },
                'reviewsRating',
                'images' => function ($query) {
                    $query->limit(7);
                },
                'reviews' => function ($query) {
                    if(user()){
                        $query->where('user_id', "!=", user()->id)->limit(5)->orderBy('id', 'desc');

                    }else{
                        $query->limit(5)->orderBy('id', 'desc');

                    }
                },
                'vendor:id,name,email'



            ])
            ->withTranslation()
            ->firstOrFail();

        if (user()) {
            $product->load('authReview');

            if ($product->authReview) {
                $product->reviews->prepend($product->authReview);
            }
        }




        $sess_id = request()->getSession()->getId();
        $key = 'products_views_' . $sess_id;

        if (!Cache::has($key)) {
            Cache::add($key, [], (60 * 60 * 24)); // 1 minute
        }

        $latest = (array) Cache::get($key);

        if (!in_array($product->id, $latest)) {
            array_push($latest, $product->id);
            $product->increment('views');
            Cache::put($key, $latest, (60 * 60 * 24));
        }



        return view('front.product.index', compact(['product']));
    }



    // ------------------------------------------------------------

    public function sellerProdcts(Admin $seller)
    {



        $products =  $seller->products()->whereHas('vendor')
            ->with([
                'attribute',
                'reviewsRating',
                'images'
            ])
            ->active()
            ->withTranslation()
            ->orderBy('id', 'desc')
            ->paginate(12);


        if (!$products->count() > 0) {
            abort(404);
        }

        return view('front.seller.products', compact(['seller', 'products']));
    }
    // ------------------------------------------------------------
    // ------------------------------------------------------------
    // ------------------------------------------------------------
}
