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

    public function product()
    {

        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }

    public function productImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id');
    }





}
