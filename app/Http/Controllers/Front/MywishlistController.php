<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Mywishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Controllers\Front\BaseController;

class MywishlistController extends BaseController
{

    use AjaxResponseTrait;


    public function index()
    {


        try {

            $wishlist_products = user()->myWishlistsProducts()->with([
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
                    ])->where('is_active', true)->withTranslation();
                },
                'reviewsRating',
                'images' => function ($images) {
                    $images->take(2);
                }

            ])->active()
                ->latest()
                ->withTranslation()
                ->paginate(8);





            return view('front.wishlist.index', compact(['wishlist_products']));
        } catch (\Exception $ex) {
            return redirect()->route('mywishlist.index')->with(['exception_error' => __('front.exception_error')]);
        }
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

            $success_message = __("front.success_add_to_wishlist");
            return $this->successMessage($success_message);
        } catch (\Throwable $th) {
            return $this->notfound();
        }
    }
    //----------------------------------------------

    //-------------------destroy------------------------

    public function destroy(Product $product)
    {



        try {

          Mywishlist::where('user_id', user()->id)->where('product_id', $product->id)->delete();



            return redirect()->route('mywishlist.index')->with(['success' => __('front.success_delete')]);
        } catch (\Exception $ex) {
            return redirect()->route('mywishlist.index')->with(['exception_error' => __('front.exception_error')]);
        }
    }
    //----------------------------------------------

}//---end fo0f classs
