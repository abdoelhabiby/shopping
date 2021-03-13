<?php

namespace App\Http\Controllers\Front;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;


class CheckoutControler extends Controller
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

        // return $request->all();

        try {

            $cart = $this->myCart(); // service class

            $total_products_count = (int) $cart->getTotalProductsQuanityt();

            $total_price =  (int) $cart->getTotalProductsPrice();


            $description = "name : " . user()->name . " email : " . user()->email;
            $charge = Stripe::charges()->create([
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'amount'   => $total_price,
                'description' => $description
            ]);

            $charge_id = $charge['id'];


            if ($charge_id) {

                //---save order and charge id
                //forget the session

                session()->forget('cart');

                $success_message = "تم اتمام الطلب";

                return redirect()->route('front.home')->with(['success' => $success_message]);
            } else {
                $error_message = "لقد حدث خطأ برجاء المحاوله مره اخر";
                return redirect()->route('front.checkout.index')->with(['error' => $error_message]);
            }
        } catch (\Throwable $th) {

            $error_message = "لقد حدث خطأ برجاء المحاوله مره اخر";
            return redirect()->route('front.checkout.index')->with(['error' => $error_message]);
        }
    }
    //------------------------------------------------



    //------------------------------------------------
}
