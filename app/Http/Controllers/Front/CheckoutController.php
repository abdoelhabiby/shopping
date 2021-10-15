<?php

namespace App\Http\Controllers\Front;

use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Laravel\Facades\Stripe;


class CheckoutController extends Controller
{
    //



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

    public function index()
    {

        if (!$this->checkCartNotEmpty()) {

            return redirect()->route('front.home');
        }


        $cart = $this->myCart(); // service class

        $total_products_count = (int) $cart->getTotalProductsQuanityt();

        $total_price =  $cart->getTotalProductsPrice();

        return view('front.checkout.index', compact(['total_products_count', 'total_price']));
    }



    //------------------------------------------------

    public function charge(Request $request)
    {


        try {

            DB::beginTransaction();

            $cart = $this->myCart(); // service class
            $products = $cart->getProducts();
            $total_price =  $cart->getTotalProductsPrice();  //total amount

            // return $cart->getProducts();

            $description = "name : " . user()->name . " email : " . user()->email;
            $charge = Stripe::charges()->create([
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'amount'   => $total_price,
                'description' => $description
            ]);



            //---------check if the payment suces or not by check charge id is return

            if (!isset($charge['id'])) {
                $error_message = "لقد حدث خطأ برجاء المحاوله مره اخر";
                return redirect()->route('front.checkout.index')->with(['error' => $error_message]);
            }


            //---save order and charge id

            $order = Order::insertGetId([
                'user_id' => user()->id,
                'charge_id' => $charge['id'],
                'amount' => $total_price,
                // 'note',
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
                        'order_id' => $order,
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

            //forget the session

            session()->forget('cart');




            DB::commit();
            $success_message = "تم اتمام الطلب";
            return redirect()->route('front.home')->with(['success' => $success_message]);
        } catch (\Throwable $th) {

            DB::rollback();
            $error_message = "لقد حدث خطأ برجاء المحاوله مره أخري";
            return redirect()->route('front.checkout.index')->with(['error' => $error_message]);
        }
    }
    //------------------------------------------------



    //------------------------------------------------
}
