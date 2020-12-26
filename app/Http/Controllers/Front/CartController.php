<?php

namespace App\Http\Controllers\Front;

use App\Cart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;

class CartController extends Controller
{


    use AjaxResponseTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     *
     */
    public function store($product_slug, $product_attribute_id)
    {


        $cart = $this->myCart();

        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id) {
                return $attribute->where('id', $product_attribute_id)->where('is_active', true)->where('qty', '>', 0);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('is_active', true)->where('id', $product_attribute_id)
                        ->where('qty', '>', 0)
                        ->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                        ]);
                }
            ])
            ->first();

        if (!$product) {
            return $this->notfound();
        }

        $cart->add($product);

        session()->put('cart', $cart);

        return session('cart')->items;

        return $this->successMessage('success');
    }

  //--------------------------------------------------------



    /**
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     *
     */
    public function destroy($id)
    {
        //
    }

    //-------------------------------------------------------

    //---------------------check if session has products-----
    private function myCart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }
    //-------------------------------------------------------
}
