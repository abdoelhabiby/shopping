<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Mywishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;

class MywishlistController extends Controller
{

    use AjaxResponseTrait;


    public function index()
    {
        $wishlists = user()->mywishlists()->with(['product' => function($p){
            return $p->with('image')->select([
                "id",
                "sku",
                "slug",
                "is_active",
                "views",
                "vendor_id"
            ]);
        }])->whereHas('product',function($product){
            return $product->active();
        })
        ->get();



        return view('front.mywishlist.index',compact('wishlists'));

    }


    //----------------save product to wishlist-------------
    public function store($product_slug)
    {


        if (!request()->ajax()) {
            return $this->notfound();
        }


        try {


            $product =  Product::active()->where('slug', $product_slug)->first();

            if (!$product) {
                return $this->notfound();
            }

            $mywishlist = Mywishlist::firstOrCreate([
                'product_id' => $product->id,
                'user_id' => user()->id
            ]);

            return $this->successMessage('ok');

        } catch (\Throwable $th) {
            return $this->notfound();
        }




    }
    //----------------------------------------------

}//---end fo0f classs
