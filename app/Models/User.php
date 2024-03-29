<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class User extends Authenticatable
{
    use Notifiable,HasEagerLimit;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','image' ,'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function myWishlistsProducts()
    {
        return $this->hasManyThrough(Product::class,Mywishlist::class,'user_id','id','id','product_id');
    }


    public function mywishlists()
    {
        return $this->hasMany(Mywishlist::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
// ---------------------------------------

public function addressDetails()
{
    return $this->hasOne(UserAddressDetails::class,'user_id','id');
}

// ---------------------------------------
// ---------------------------------------
// ---------------------------------------

}
