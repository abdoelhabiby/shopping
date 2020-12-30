<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable= [
        "product_id",
        "name",
    ];

    protected $hidden = ['created_at','updated_at'];


    // public function getNameAttribute($name)
    // {
    //     return asset("/") . $name;
    // }

}
