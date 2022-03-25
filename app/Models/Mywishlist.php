<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Mywishlist extends Model
{

    use HasEagerLimit;


    protected $fillable = [
        'user_id', 'product_id'
    ];



    public function products()
    {
        return $this->hasMany(Product::class,'product_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
