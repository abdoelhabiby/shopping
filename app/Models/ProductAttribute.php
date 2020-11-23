<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use Translatable, SoftDeletes, GlobalMethodUesdInModels;

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
        'created_at' => 'datetime:Y-m-d h:i:s',

    ];


    protected $appends = ['hasOffer'];


    public function getHasOfferAttribute()
    {


       $check_end_offer =  Carbon::parse($this->end_offer_at)->gt(Carbon::now());

         if($this->price_offer && $this->start_offer_at && $check_end_offer ){
             return true;
         }
         return false;

    }






    //------------------end calss----------------
}
