<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use Translatable,SoftDeletes,GlobalMethodUesdInModels;

    protected $fillable = [
        "sku",
        "qty",
        "product_id",
        "is_active",
        "purchase_price",
        "price",
        "price_offer",
        "start_offer_at",
        "end_offer_at",
    ];


    protected $translatedAttributes = ['name'];


      protected $casts = [
          'created_at' => 'datetime:Y-m-d h:i:s'
      ];

}
