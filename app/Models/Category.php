<?php

namespace App\Models;

use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use Translatable;

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


    protected $translatedAttributes = ['name'];


    protected $casts = [
        // 'is_active' => 'boolean',
        'created_at' => 'datetime'
    ];


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
        //return $this->name;
        $locale = \Config::get('app.locale');
        $fallback_locale = \Config::get('translatable.fallback_locale');


        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id');
                    //  ->where('locale', $locale)
                    //  ->orWhere('locale','ar');
    }
    //--------------------------------------------


    //----------------get sub gategories chields-----------
    public function chields()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    //----------------get main category parent-----------

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }


    //------------------------return attibute is active prety-------------
    public function getIsActiveAttribute($p)
    {
        return $p == true ? 'active' : 'deactive';
    }

    //------------------return prety date---------------------
    public function getCreatedAtAttribute($p)
    {
        return  date('Y-m-d h:i:s', strtotime($p));
    }


    //---------------------------------------------------------

} ///end of class model
