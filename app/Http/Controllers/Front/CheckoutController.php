<?php

namespace App\Http\Controllers\Front;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Traits\StripeTrait;
use App\Http\Traits\MyfatoorahTrait;
use App\Http\Controllers\Front\BaseController;


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
            abort(404); //or send not supported
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
}
