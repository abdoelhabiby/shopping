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


        try {

            $wishlist_product_ids = user()->mywishlists()->pluck('product_id')->toArray();
            $wishlist_products = Product::whereIn('id', $wishlist_product_ids)->with(
                [
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
                        ])->where('is_active', true);
                    },
                    'reviews' => function ($rev) {
                        return $rev->select(
                            'product_id',
                            \DB::raw("ROUND(SUM(quality) * 5 / (COUNT(id) * 5)) as stars"),
                            \DB::raw("COUNT(product_id) as total_rating"),
                        )->groupBy('product_id');
                    }

                ]
            )->active()->latest()->paginate(8);


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

    public function destroy($product_id)
    {


        try {

            Mywishlist::where('user_id', user()->id)->where('product_id', $product_id)->delete();

            return redirect()->route('mywishlist.index')->with(['success' => __('front.success_delete')]);
        } catch (\Exception $ex) {
            return redirect()->route('mywishlist.index')->with(['exception_error' => __('front.exception_error')]);
        }
    }
    //----------------------------------------------

}//---end fo0f classs
