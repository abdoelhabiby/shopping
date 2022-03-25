<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class ProductReview extends Model
{
    use HasEagerLimit;

    protected $fillable = [
        "product_id",
        "user_id",
        "quality",
        "title",
        "review",
    ];

    protected $casts = [
        'quality' => 'integer',
    ];


    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d h:i:s'
    // ];

    protected $hidden = ['updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
