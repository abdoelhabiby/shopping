<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Order extends Model
{
    use SoftDeletes,HasEagerLimit;

    protected $fillable = [
        'user_id',
        'charge_id',
        'amount',
        'note',
        'status',
        'payment_gateway',
        'payment_method',
        'refused_reason',
        'return_quantity'
    ];

    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d H:i:s'
    // ];


    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }



    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products','order_id','product_id');
    }



}
