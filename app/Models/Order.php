<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'charge_id',
        'amount',
        'note',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }







}
