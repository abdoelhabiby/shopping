<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class ProductImage extends Model
{
    use HasEagerLimit;
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
