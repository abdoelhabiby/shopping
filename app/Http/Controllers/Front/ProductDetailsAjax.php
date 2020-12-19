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


    public function index($product_id,ProductAttribute $attribute)
    {

        if(!request()->ajax()){
            return $this->notfound();
        }

        $product = Product::active()
        ->with(['attributes' => function($at){
            return $at->where('is_active',true);
        }])
        ->findOrFail($product_id);



        $get_modal_has_product_detilas = view('front.includes/_modal_product_details',['product' => $product,'attribute' => $attribute])->render();

        return $this->returnRenderHtml('quickview_modal',$get_modal_has_product_detilas);
    }


}
