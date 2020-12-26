<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;

class ProductDetailsAjax extends Controller
{

    use AjaxResponseTrait;

    //get product details ande return as render html modal


    public function index($product_sku, $attribute_sku)
    {



        if (!request()->ajax()) {
            return $this->notfound();
        }



        $product =  Product::active()->where('sku',$product_sku)
        ->whereHas('attribute', function ($attribute) use ($attribute_sku) {
            return $attribute->where('sku',$attribute_sku)->where('is_active', true);
        })
        ->with([
            'attribute' => function ($attr) use ($attribute_sku) {
                return $attr->where('is_active', true)->where('sku', $attribute_sku)->first();
            },
            'attributes' => function ($at) {
                return $at->where('is_active', true);
            }
        ])
        ->first();



        // $product = Product::active()
        //     ->whereHas('attribute', function ($attribute) use ($attribute_id) {
        //         return $attribute->where('id', $attribute_id)->where('is_active', true);
        //     })
        //     ->with([
        //         'attribute' => function ($attr) use ($attribute_id) {
        //             return $attr->where('is_active', true)->where('id', $attribute_id)->first();
        //         },
        //         'attributes' => function ($at) {
        //             return $at->where('is_active', true);
        //         }
        //     ])
        //     ->find($product_id);


            if(!$product){
            return $this->notfound();

            }




        $get_modal_has_product_detilas = view('front.includes/_modal_product_details', ['product' => $product])->render();

        return $this->returnRenderHtml('quickview_modal', $get_modal_has_product_detilas);
    }



    //-----------------------------------------------





} //end of class
