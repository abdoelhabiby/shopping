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

    public function index($product_slug, $product_attribute_id)
    {


        // return $product_attribute_id;

        if (!request()->ajax()) {
            return $this->notfound();
        }



        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id) {
                return $attribute->where('id', $product_attribute_id)->where('is_active', true);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('is_active', true)->where('id', $product_attribute_id)->withTranslation();
                },
                'attributes' => function ($at) {
                    return $at->where('is_active', true)->withTranslation();
                },
                'image'
            ])
            ->withTranslation()
            ->first();




        if (!$product) {
            return $this->notfound();
        }




        $get_modal_has_product_detilas = view('front.includes._modal_product_details', ['product' => $product])->render();

        return $this->returnRenderHtml('quickview_modal', $get_modal_has_product_detilas);
    }



    //-----------------------------------------------





} //end of class
