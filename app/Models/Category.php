<?php

namespace App\Models;

use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Category extends Model
{
    use Translatable,GlobalMethodUesdInModels,HasEagerLimit;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    protected $fillable = [
        'parent_id',
        'slug',
        'is_active',
        'image',
        'meta_keywords',
        'meta_description'
    ];


    protected $hidden = ['pivot','translations'];
    protected $translatedAttributes = ['name'];


    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d h:i:s'
    // ];

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s',strtotime($value));
    }
//-------add scope is active--------------


public function scopeActive($q)
{
    return $q->where('is_active', true);
}


    //---------------get main categories----------------

    public function scopeMainCategory($q)
    {
        return $q->where('parent_id', null);
    }

    //---------------get sub categories----------------


    public function scopeSubCategory($q)
    {
        return $q->whereNotNull('parent_id');
    }



    //----------------------- relation to get default translation data in datatabales-------------------
    public function translation_default()
    {

        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id');
    }
    //--------------------------------------------


    //----------------get sub gategories chields-----------
    public function chields()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    //----------------get sub gategories chield-----------
    public function chield()
    {
        return $this->hasOne(self::class, 'parent_id', 'id');
    }

    //----------------get main category parent-----------

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }



    //---------------get product by relation has many throught-------------


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories',  'category_id');
    }




    //------------------------------------------------------------


} ///end of class model
