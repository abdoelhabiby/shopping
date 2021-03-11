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

    // private $total_price = 0;
    // private $total_products_quantity = 0;

    /**
     * Display a listing of the resource.
     * $cart class
     * $products return from cart class products as array of objects
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cart = $this->myCart(); // service class

        $products = $cart->getProducts();
        $total_products_count = (int) $cart->getTotalProductsQuanityt();
        $total_price =  $cart->getTotalProductsPrice();

        return view('front.cart.index', compact(['products', 'total_products_count', 'total_price']));
    }



    /**
     *
     */
    public function store($product_slug, $product_attribute_id)
    {

        if (!request()->ajax()) {
            return $this->notfound();
        }



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


        //check if add with quantity--

         $quantity =  request()->quantity;

          $cart->add($product,$quantity) ; // return true or false

         session()->put('cart', $cart);


        return $this->returnResponseJsone('cart_products_count', $cart->getCountProducts());
    }

    //--------------------------------------------------------



    /**
     *
     */
    public function update($product_slug, $product_attribute_id)
    {

        $quantity = (int) request()->quantity;
        if (!$quantity > 0) {
            return redirect()->back();
        }

        $cart = $this->myCart();

        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id, $quantity) {
                return $attribute->where('id', $product_attribute_id)->where('is_active', true);
                // return $attribute->where('id', $product_attribute_id)->where('is_active', true)->where('qty', '>=', $quantity);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('is_active', true)->where('id', $product_attribute_id)
                        ->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                        ]);
                }
            ])
            ->firstOrFail();



        if (!$cart->update($product, $quantity)) {
            return redirect()->route('cart.index')->with(['error' => 'input valid data']);

        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with(['success' => 'success update']);
    }

    /**
     * delete product from cart
     */
    public function destroy($product_slug, $product_attribute_id)
    {


        $cart = $this->myCart();

        $product =  Product::active()->where('slug', $product_slug)
            ->whereHas('attribute', function ($attribute) use ($product_attribute_id) {
                return $attribute->where('id', $product_attribute_id);
            })
            ->with([
                'attribute' => function ($attr) use ($product_attribute_id) {
                    return $attr->where('id', $product_attribute_id)
                        ->select([
                            "id",
                            "sku",
                            "qty",
                            "product_id",
                        ]);
                }
            ])
            ->firstOrFail();

        if (!$cart->delete($product)) {
            abort(404);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with(['success' => 'success delete']);
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

    //-------------------------------------------------------
}
