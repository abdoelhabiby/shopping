<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $timestamps = false;




    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

}
