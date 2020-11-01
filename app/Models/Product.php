<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use Translatable,SoftDeletes,GlobalMethodUesdInModels;

    protected $fillable = [
        "sku",
        "slug",
        "is_active",
        "parent_is_active",
        "meta_keywords",
        "brand_id",
        "views",
        "vendor_id",
    ];

    protected $translatedAttributes = ['name','description'];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];


    // public function category()
    // {
    //     return $this->belongsTo(Category::class,'category_id','id');
    // }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function vendor()
    {
        return $this->belongsTo(Admin::class,'vendor_id','id');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }


    public function categories()
    {

         return $this->belongsToMany(Category::class,'product_categories','product_id','category_id')->withOut('translation');
    }



}
