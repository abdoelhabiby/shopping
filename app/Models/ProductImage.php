<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable= [
        "product_id",
        "name",
    ];


    // public function getNameAttribute($name)
    // {
    //     return asset("/") . $name;
    // }

}
