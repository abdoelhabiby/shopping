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
                        "purchase_price",
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
                        "purchase_price",
                        "price",
                        "price_offer",
                        "start_offer_at",
                        "end_offer_at",
                        "id",

                    ]);
                },
                'images' => function ($image) {
                    return $image->select(['product_id', 'name'])->limit(7);
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
                'reviews' => function ($query) {
                    return $query->where('user_id', "!=", user() ? user()->id : null)->with(['user' => function ($user) {
                        return $user->select(['id', 'name', 'image']);
                    }])->limit(5);
                }
            ])
            ->first();

        if (!$product) {
            abort(404);
        }



        $user_product_review = null;
        if (user()) {
            $user_product_review = ProductReview::where('product_id', $product->id)->where('user_id', user()->id)->first();
        }

        $calculate_reviews = ProductReview::select(
            \DB::raw("ROUND(SUM(quality) * 5 / (COUNT(id) * 5)) as stars"),
            // \DB::raw("COALESCE( ROUND(SUM(quality) * 5 / (COUNT(id) * 5)),0)  as stars"),
            \DB::raw("COUNT(id) as total_rating"),
        )->where('product_id', $product->id)->first();



        return view('front.product.index', compact(['product', 'user_product_review', 'calculate_reviews']));
    }
}
