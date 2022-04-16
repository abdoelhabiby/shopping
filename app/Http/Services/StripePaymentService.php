<?php

namespace App\Http\Services;

use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use App\Models\UserAddressDetails;
use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;


class StripePaymentService
{


    private static function newStripe()
    {
        return new Stripe(env('STRIPE_SECRET_KEY'));
    }


    public static function cart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }


    public static function init()
    {


        $total_products_count = (int) self::cart()->getTotalProductsQuanityt();

        $total_price =  self::cart()->getTotalProductsPrice();
        $data = [
            'total_products_count' => $total_products_count,
            'total_price' => $total_price
        ];

        return view('front.checkout.stripe', compact('data'));
    }

    // ----------------------------------------

    public static function charge($token, $description, UserAddressDetails $user_address_details)
    {




        $cart = self::cart();
        $stripe = self::newStripe();
        $total_price =  $cart->getTotalProductsPrice();


        $customer_id = self::createCustomer($token, $user_address_details);

        $charge = $stripe->charges()->create([
            'currency' => 'EGP',
            'amount'   => $total_price,
            'description' => $description,
            "customer" => $customer_id

        ]);


        if ((int) substr($total_price, 0, 1)  != (int) substr($charge['amount_captured'], 0, 1)) {

            throw new Exception('stribe payemnts dosent equals');
        }



        if (isset($charge['id']) && isset($charge['status']) && $charge['status'] == 'succeeded') {

            $payment_method = $charge['payment_method_details']['card']['brand'];

            $charge  = [
                'charge_id' => $charge['id'],
                'status' => $charge['status'],
                'amount' => $charge['amount'],
                'currency' => $charge['currency'],
                'payment_method' => $payment_method
            ];


            return $charge;
        }

        return false;
    }


    // --------------------------------------


    protected static function createCustomer($token,  $user_address_details)
    {

        $stripe = self::newStripe();

        $address = [

            "country" =>  'egypt',
            'city' => $user_address_details->address,
            // "line1" =>  null,
            // "line2" =>  'line2',
            // "postal_code" =>  '2254',
            // "state" =>  'cr7'
        ];

        $customer = $stripe->customers()->create(array(
            "source" => $token,
            "email" => $user_address_details->email,
            "name" =>  $user_address_details->first_name . " " . $user_address_details->last_name,
            "phone" =>  $user_address_details->phone,
            'address' => $address,
        ));

        return $customer['id'];
    }


    // ----------------------------------
    // ----------------------------------


}
