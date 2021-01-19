<?php

namespace App\Models;

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

}
