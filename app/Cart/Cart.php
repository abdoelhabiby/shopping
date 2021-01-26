<?php

namespace App\Cart;

use App\Models\Product;

class Cart
{
    public $items = [];



    public function __construct($cart = null)
    {


        if ($cart) {

            $this->items = $cart->items;
        } else {
            $this->items = [];
        }
    }

    //------------------add items to cart----------------------

    // ---------------------------------------------------
    public function add($product, $quantity = null)
    {
        $add_with_quantity = null;

        if ($quantity && ((int)$quantity) > 0) {
            $add_with_quantity = (int) $quantity;
        }


        $item_key_name = $product->sku . '_' . $product->attribute->sku;

        //-----------check if product found in cart-------------

        if (array_key_exists($item_key_name, $this->items)) {

            //--------------update the quantity-------------
            $item = $this->items[$item_key_name];

            if ($add_with_quantity) {


                if ($add_with_quantity <= $product->attribute->qty) {
                    $this->update($product, $add_with_quantity);
                }

                return true;

            } else {
                return response('err',404);
                if ($item['quantity'] + 1 <= $product->attribute->qty) {
                    $item['quantity'] += 1;
                }
            }

            return true;

        }
        //----------------------------------------------------

        $check_quantity = 1;

        if ($add_with_quantity) {

            if ($add_with_quantity <= $product->attribute->qty) {
                $check_quantity = $add_with_quantity;
            }
        }

        $this->items[$item_key_name] = [
            'product_sku' =>  $product->sku,
            'attribute_id' =>  $product->attribute->id,
            'quantity' => $check_quantity
        ];


        return true;
    } //end class add item
    // ---------------------------------------------------
    // ----------------update ----------------------------

    public function update($product, $quantity)
    {



        $items =  $this->items;
        $item_key_name = $product->sku . '_' . $product->attribute->sku;

        if (array_key_exists($item_key_name, $items)) {

            $items[$item_key_name]['quantity'] = $quantity;

            $this->items = $items;

            return true;
        }

        return false;
    }


    // ---------------------------------------------------

    // -----------------remove product from items-----------

    public function delete($product)
    {

        $items =  $this->items;
        $item_key_name = $product->sku . '_' . $product->attribute->sku;

        if (array_key_exists($item_key_name, $items)) {

            unset($items[$item_key_name]);

            $this->items = $items;

            return true;
        }

        return false;
    }
    // ---------------------------------------------------




    //-------------------get count products---------------


    public function getCountProducts()
    {
        $counts = 0;

        if (count($this->items) > 0) {

            foreach ($this->items as $item) {
                $counts += isset($item['quantity']) ? $item['quantity'] : 0;
            }
        } else {
            $counts = 0;
        }

        return $counts;
    }

    //-----------------------get products--------------------




    //-------------------------------------------------
}// end of class
