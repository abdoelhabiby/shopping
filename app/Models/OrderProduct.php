<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_attribute_id',
        'quantity',
        'price',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
