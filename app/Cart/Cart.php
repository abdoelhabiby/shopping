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
    public function add($product)
    {

        $item_key_name = $product->sku . '_' . $product->attribute->sku;

        if (array_key_exists($item_key_name, $this->items)) {

            if ($this->items[$item_key_name]['quantity'] + 1 <= $product->attribute->qty) {
                $this->items[$item_key_name]['quantity'] += 1;
            }

            // $this->items[$item_key_name]['quantity'] += 1;

            return true;
        }

        // $check_quantity = $quantity <= $product->attribute->qty ? $quantity : 1;

        $this->items[$item_key_name] = [
            'product_sku' =>  $product->sku,
            'attribute_id' =>  $product->attribute->id,
            'quantity' => 1
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
