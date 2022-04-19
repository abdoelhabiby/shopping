<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddressDetails extends Model
{

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'second_address',
        'phone',
        'second_phone'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
