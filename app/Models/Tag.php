<?php

namespace App\Models;

use App\Models\TagTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Http\Traits\GlobalMethodUesdInModels;

class Tag extends Model
{
    use Translatable,GlobalMethodUesdInModels;

    protected $with = ['translations'];
    protected $hidden = ['pivot','translations'];

   protected $fillable = [
        'slug',
        'is_active',
    ];

    protected $translatedAttributes = ['name'];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s'
    ];



     //----------------------- relation to get default translation data in datatabales-------------------
     public function translation_default()
     {

         return $this->hasOne(TagTranslation::class, 'tag_id', 'id');
     }


}
