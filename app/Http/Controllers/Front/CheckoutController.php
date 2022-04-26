<?php

namespace App\Http\Controllers\Front;

use Exception;
use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Traits\StripeTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\MyfatoorahTrait;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\StripePaymentService;
use App\Http\Controllers\Front\BaseController;
use App\Http\Services\AdminNotificationService;


class CheckoutController extends BaseController
{
    use MyfatoorahTrait, StripeTrait;

    protected $payments_gateway = ['stripe', 'myfatoorah'];


    private function myCart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }


    private function checkCartNotEmpty()
    {


        $cart = $this->myCart(); // service class

        $total_products_count = (int) $cart->getTotalProductsQuanityt();

        $total_price =  (int) $cart->getTotalProductsPrice();

        if ($total_products_count > 0 && $total_price > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function index(Request $request, $gateway)
    {


        if (!in_array($gateway, $this->payments_gateway)) {
            abort(404);
        }

        if (!$this->checkCartNotEmpty()) {

            return redirect()->route('front.home');
        }


        switch ($gateway) {
            case 'stripe': {

                    return $this->paymentWithSrtipeInit();
                }
                break;

            case 'myfatoorah': {
                    return $this->paymentWithMyfatoorahInit();
                }
                break;
            default:

                return redirect()->route('front.home');
        }
    }

    //------------------------------------------------



    protected function saveOrder($charge_id, $payment_gateway, $payment_method, Cart $cart)
    {
        $products = $cart->getProducts();
        $total_price =  $cart->getTotalProductsPrice();  //total amount


        //---save order and charge id

        //payment status =>>>> 'pending','paid','refused'
        //and default pending

        $order = Order::create([
            'user_id' => user()->id,
            'charge_id' => $charge_id,
            'amount' => $total_price,
            'payment_gateway' => $payment_gateway,
            'payment_method' => $payment_method,
            'created_at' => now(),
        ]);


        //---------------save order products---------
        $order_products = [];

        foreach ($products as $product) {

            //---------get real price by check if the product has offer------
            if ($product->attribute->hasOffer) {
                $real_price = $product->attribute->price_offer;
            } else {
                $real_price = $product->attribute->price;
            } //-----end check if has offer----------

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            //check the user select found in stock
            if ($user_count_selected <= $product->attribute->qty) {
                $check_quantity = $user_count_selected;
            }


            if ($check_quantity > 0) {

                $order_products[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_attribute_id' => $product->attribute->id,
                    'quantity' => $check_quantity,
                    'price' => $real_price,
                    'created_at' => now(),

                ];

                //---------decrement the quantity-------------

                $product->attribute->decrement('qty', $check_quantity);
            }
        } //---end of foreach

        //--------save order products in database----

        OrderProduct::insert($order_products);

        return $order;
    }



    //------------------------------------------------
}
