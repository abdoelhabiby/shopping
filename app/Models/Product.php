<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Staudenmeir\EloquentParamLimitFix\ParamLimitFix;

class Product extends Model
{

    use Translatable, SoftDeletes, GlobalMethodUesdInModels,HasEagerLimit;


    protected $translatedAttributes = ['name', 'description'];
    protected $hidden = ['pivot', 'translations'];


    protected $fillable = [
        "sku",
        "slug",
        "is_active",
        "parent_is_active", // check what is beast remove this coulmn or still
        "meta_keywords",
        "brand_id",
        "views",
        "vendor_id",
    ];




    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];



    //------------------get brand relation-----------
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
        // return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault();
    }

    //-------------get Product owner -----------------

    public function vendor()
    {
        return $this->belongsTo(Admin::class, 'vendor_id', 'id');
    }

    //------------------get images relation-----------

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }


    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    //------------------get categories relation-----------

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }



    //------------------get tags relation-----------

    public function tags()
    {

        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    //------------------get firast image relation to show in index table-----------

    public function firstImage()
    {
        return $this->images()->first();
        // return $this->hasOne(ProductImage::class, 'product_id', 'id');

    }


    public function authReview()
    {

            return  $this->hasOne(ProductReview::class,'product_id','id')->where('user_id',user()->id);

    }


    //--------------------------get relation has many attributes--------

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }


    //--------------------------get one relation  attributes--------


    public function attribute()
    {
        return $this->hasOne(ProductAttribute::class, 'product_id', 'id');
    }


    //---------------------get product active--------------------------

    /**
     * get products active by categories and has attributeactive
     * used in front views
     * neeeeed to upgrade  // ----- important------
     */

    public function scopeActive($product)
    {
        return $product->where('is_active', true)
            // ->whereHas('categories', function ($cate) {
            //     return $cate->where('is_active', true);
            // })
            ->whereHas('attributes', function ($attr) {
                return $attr->where('is_active', true);
            });
    }



    // -----------------------------------------

    public function reviewsRating()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')->select(
            'product_id',
            \DB::raw("ROUND(SUM(quality) * 5 / (COUNT(id) * 5)) as stars"),
            \DB::raw("COUNT(product_id) as total_rating")
        )->groupBy('product_id');
    }
    // -----------------------------------------

    // -----------------------------------------


    public function offer()
    {
        return $this->hasOne(ProductAttribute::class, 'product_id', 'id')
            ->where('is_active', true)
            ->where('qty', '>', 0)
            ->whereNotNull('price_offer')
            ->whereNotNull('start_offer_at')
            ->whereDate('end_offer_at', '>', now());
    }


    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }
}
