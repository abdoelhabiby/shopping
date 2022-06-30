<?php

namespace App\Http\Traits;

use App\Cart\Cart;
use App\Models\Order;
use App\Models\OrderProduct;

trait SaveOrderTrait
{
    public function saveOrder($user_id,$charge_id, $payment_gateway, $payment_method, Cart $cart)
    {
        $products = $cart->getProducts();
        $total_price =  $cart->getTotalProductsPrice();  //total amount


        //---save order and charge id

        //payment status =>>>> 'pending','paid','refused'
        //and default pending

        $order = Order::create([
            'user_id' => $user_id,
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
}
