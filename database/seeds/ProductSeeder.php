<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            "sku" => 'POOI',
            "slug" => 'tshirt-blue',
            "vendor_id" => 1,
            "en" => ['name' => 'tshirt blue', 'description' => 'ddddddddd'],
            "ar" => ['name' => 'تيشيرت ازرق', 'description' => 'ddddddddd'],
        ];

        $product = Product::create($data);

        $categ = Category::where('slug', 'tshirt')->first();

        if ($categ) {
            $product->categories()->attach([$categ->id]);
        }


        $attribute = [
            "sku" => 'POOI-s',
            "qty" => 5,
            "purchase_price" => 155,
            "price" => 188,
            "en" => ['name' => 'small'],
            "ar" => ['name' => 'small'],

        ];

        $product_attribute = new ProductAttribute($attribute);

        $product->attributes()->save($product_attribute);

      //-------------------------------------------------------------


        $data = [
            "sku" => 'POPP',
            "slug" => 'tshirt-dark',
            "vendor_id" => 1,
            "en" => ['name' => 'tshirt dark', 'description' => 'ddddddddd'],
            "ar" => ['name' => 'تيشيرت dark', 'description' => 'ddddddddd'],
        ];

        $product = Product::create($data);

        $categ = Category::where('slug', 'tshirt')->first();

        if ($categ) {
            $product->categories()->attach([$categ->id]);
        }

        $attribute = [
            "sku" => 'POPP-s',
            "qty" => 2,
            "purchase_price" => 157,
            "price" => 198,
            "en" => ['name' => 'small'],
            "ar" => ['name' => 'small'],

        ];
        $product_attribute = new ProductAttribute($attribute);
        $product->attributes()->save($product_attribute);


      //-------------------------------------------------------------


        $data = [
            "sku" => 'ASE',
            "slug" => 'ascer',
            "vendor_id" => 1,
            "en" => ['name' => 'acser', 'description' => 'ddddddddd'],
            "ar" => ['name' => 'acser ar ', 'description' => 'ddddddddd'],
        ];

        $product = Product::create($data);

        $categ = Category::where('slug', 'laptop-games')->first();

        if ($categ) {
            $product->categories()->attach([$categ->id]);
        }

        $attribute = [
            "sku" => 'ASE-1',
            "qty" => 2,
            "purchase_price" => 4000,
            "price" => 10000,
            "en" => ['name' => '16 inc'],
            "ar" => ['name' => '16 بوصه'],

        ];
        $product_attribute = new ProductAttribute($attribute);
        $product->attributes()->save($product_attribute);



    }  // end methodm run




} //end of class
