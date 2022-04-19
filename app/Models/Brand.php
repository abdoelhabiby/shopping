<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Brand extends Model
{
    use Translatable,GlobalMethodUesdInModels,HasEagerLimit;

    protected $with = ['translations'];

   protected $fillable = [
        'slug',
        'is_active',
        'image',
        'meta_keywords',
        'meta_description',
        // 'main_category_id'
    ];
    protected $hidden = ['pivot','translations'];

    protected $translatedAttributes = ['name'];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];


    // public function category()
    // {
    //     return $this->belongsTo(Category::class,'main_category_id','id')->withDefault();
    // }

}
