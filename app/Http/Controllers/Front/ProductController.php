<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($product_slug, $product_attribute_id)
    {
        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id) {
                return $attribute->where('id', $product_attribute_id)->where('is_active', true);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('is_active', true)->where('id', $product_attribute_id);
                },
                'attributes' => function ($at) {
                    return $at->where('is_active', true);
                },
                'images' => function ($image) {
                    return $image->select(['product_id', 'name'])->limit(7);
                },
                'categories',
                'tags',
                'brand'  => function ($brand) {
                    return $brand->where('is_active', true)->select(['id', 'slug']);
                }
            ])
            ->first();

        if (!$product) {
            abort(404);
        }

        //  return $product;



        return view('front.product.index', compact('product'));
    }
}
