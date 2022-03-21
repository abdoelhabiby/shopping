<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductController extends Controller
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
                'images' => function($query){
                    $query->limit(7);

                },'reviews' => function($query){
                    $query->where('user_id',"!=",user()->id)->limit(5)->orderBy('id','desc');
                },


            ])
            ->firstOrFail();

            if(user()){
                $product->load('authReview');

                if($product->authReview ){
                    $product->reviews->prepend($product->authReview);
                }
            }



        return view('front.product.index', compact(['product']));
    }
}
