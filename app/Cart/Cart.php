<?php

namespace App\Cart;

use App\Models\Product;

class Cart
{
    public $items = [];

    private $total_price = 0;
    private $total_products_quantity = 0;


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


    public function getProducts()
    {

        // $cart = $this->myCart();
        $items = $this->items;
        $products = [];

        foreach ($items as $key => $item) {
            if (isset($item['product_sku']) && isset($item['attribute_id'])) {

                $attribute_id = $item['attribute_id'];
                $product = Product::active()->where('sku', $item['product_sku'])
                    ->whereHas('attribute', function ($query) use ($attribute_id) {
                        return $query->where('id', $attribute_id)->where('is_active', true);
                    })
                    ->with([
                        'attribute' => function ($query) use ($attribute_id) {
                            return $query->where('id', $attribute_id)->where('is_active', true)->select([
                                "id",
                                "sku",
                                "qty",
                                "product_id",
                                "is_active",
                                "price",
                                "price_offer",
                                "start_offer_at",
                                "end_offer_at",
                            ]);
                        }, 'image'
                    ])
                    ->select([
                        "id",
                        "sku",
                        "slug",
                        "is_active",
                    ])
                    ->first();

                if ($product) {
                    $product->user_select_quantity = $item['quantity'];
                    $products[] = $product;
                }
            }

        } // end forach

        return $products;
    }

    //--------------get totla products quantity-----

    public function  getTotalProductsQuanityt()
    {
        $products = $this->getProducts();

        $total_products_quantity = $this->total_products_quantity;

        foreach ($products as $product) {

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            if ($user_count_selected <= $product->attribute->qty) { //check the user select found in stock
                $check_quantity = $user_count_selected;
            }

            $total_products_quantity += $check_quantity;
        }

        return $total_products_quantity;
    }

    //-----------------get total price---------------

    public function getTotalProductsPrice()
    {
        $products = $this->getProducts();

        $total_price = $this->total_price;

        foreach ($products as $product) {

            if ($product->attribute->hasOffer) {
                $real_price = $product->attribute->price_offer;
            } else {
                $real_price = $product->attribute->price;
            }

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            if ($user_count_selected <= $product->attribute->qty) { //check the user select found in stock
                $check_quantity = $user_count_selected;
            }

            $total_price += $real_price *  $check_quantity;
        }

        return $total_price;
    }



    //-------------------------------------------------
}// end of class
