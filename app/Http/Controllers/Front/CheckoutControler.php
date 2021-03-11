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


    public function index()
    {

        $cart = $this->myCart(); // service class

        $total_products_count = (int) $cart->getTotalProductsQuanityt();

        $total_price =  $cart->getTotalProductsPrice();

        if ($total_products_count > 0 && $total_price > 0){
            return view('front.checkout.index', compact(['total_products_count', 'total_price']));
        }

        return redirect()->route('front.home');

    }



    //------------------------------------------------

    public function charge(Request $request)
    {


        try {


            $description = "name : " . user()->name . " email : " . user()->email;
            $charge = Stripe::charges()->create([
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'amount'   => $request->amount,
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
}
