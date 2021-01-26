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

    private $total_price = 0;
    private $total_products_quantity = 0;

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

        $products = $this->getProducts();
        $total_products_count = (int) $this->getTotalProductsQuanityt();
        $total_price =  $this->getTotalProductsPrice();

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


        $quantity =  request()->quantity ??  null;
        $cart->add($product,$quantity);
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
                return $attribute->where('id', $product_attribute_id)->where('is_active', true)->where('qty', '>=', $quantity);
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
            abort(404);
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
    public function getProducts()
    {

        $cart = $this->myCart();
        $items = $cart->items;
        $products = [];

        foreach ($items as $key => $item) {
            if (isset($item['product_sku']) && isset($item['attribute_id'])) {

                $attribute_id = $item['attribute_id'];
                $product = Product::active()->where('sku', $item['product_sku'])
                    ->whereHas('attribute', function ($query) use ($attribute_id) {
                        return $query->where('id', $attribute_id)->where('is_active', true);
                    })
                    ->with([
                        'attribute' => function ($query) use ($attribute_id) {
                            return $query->where('id', $attribute_id)->where('is_active', true)->select([
                                "id",
                                "sku",
                                "qty",
                                "product_id",
                                "is_active",
                                "price",
                                "price_offer",
                                "start_offer_at",
                                "end_offer_at",
                            ]);
                        }, 'images' => function ($query) {
                            return $query->select(['product_id', 'name']);
                        }
                    ])
                    ->select([
                        "id",
                        "sku",
                        "slug",
                        "is_active",
                    ])
                    ->first();

                if ($product) {
                    $product->user_select_quantity = $item['quantity'];
                    $products[] = $product;
                }
            }

        } // end forach

        return $products;
    }

    //--------------get totla products quantity-----

    public function  getTotalProductsQuanityt()
    {
        $products = $this->getProducts();

        $total_products_quantity = $this->total_products_quantity;

        foreach ($products as $product) {

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            if ($user_count_selected <= $product->attribute->qty) { //check the user select found in stock
                $check_quantity = $user_count_selected;
            }

            $total_products_quantity += $check_quantity;
        }

        return $total_products_quantity;
    }

    //-----------------get total price---------------

    public function getTotalProductsPrice()
    {
        $products = $this->getProducts();

        $total_price = $this->total_price;

        foreach ($products as $product) {

            if ($product->attribute->hasOffer) {
                $real_price = $product->attribute->price_offer;
            } else {
                $real_price = $product->attribute->price;
            }

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            if ($user_count_selected <= $product->attribute->qty) { //check the user select found in stock
                $check_quantity = $user_count_selected;
            }

            $total_price += $real_price *  $check_quantity;
        }

        return $total_price;
    }
    //-------------------------------------------------------
}
