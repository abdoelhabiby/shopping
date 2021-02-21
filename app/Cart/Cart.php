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


    private function checkValidQuantity($product, $quantity)
    {

        if ($quantity <= $product->attribute->qty && $quantity > 0) {
            return true;
        } else {
            return false;
        }
    }


    // ---------------------------------------------------
    public function add($product, $quantity)
    {

        $item_key_name = $product->sku . '_' . $product->attribute->sku;



        $add_with_quantity = $quantity ?? null;
        // $add_with_quantity = (int) $quantity;




        //-----------check if product found in cart-------------

        if (array_key_exists($item_key_name, $this->items)) {

            //--------------update the quantity-------------
            $item = $this->items[$item_key_name];

            if ($add_with_quantity) {
                $new_quantity = (int) $add_with_quantity;
            }else{
                $new_quantity = $item['quantity'] + 1;
            }


           return $this->update($product, $new_quantity);
        }

        //----------------------------------------------------

        $real_quantity = 1;

        if ($add_with_quantity) {
            $real_quantity = (int) $add_with_quantity;
        }

        $check_valid_quantity = $this->checkValidQuantity($product, $real_quantity);

        if(!$check_valid_quantity){
            return false;
        }

        $this->items[$item_key_name] = [

            'product_sku' =>  $product->sku,
            'attribute_id' =>  $product->attribute->id,
            'quantity' => $real_quantity

        ];


        return true;
    } //end class add item

    //---------------------------------------------------

    // ---------------------------------------------------
    // ----------------update ----------------------------

    public function update($product, $quantity)
    {



        $items =  $this->items;
        $item_key_name = $product->sku . '_' . $product->attribute->sku;

        $check_valid_quantity = $this->checkValidQuantity($product, $quantity);

        if(!$check_valid_quantity){
             return false;
        }

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
