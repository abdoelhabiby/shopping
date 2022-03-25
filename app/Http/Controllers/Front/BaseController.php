<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{

    public function __construct()
    {
        $ttl = 60 * 60 * 24;
        $main_categories_home = Cache::remember('main_categories_views_shared', $ttl, function () {
            return Category::mainCategory()->with(['chields' => function ($q) {
                return $q->select(['parent_id', 'slug', 'id'])->whereHas('chields', function ($chield) {
                    return $chield->where('is_active', true)->whereHas('products');
                })->withTranslation();
            }])->active()->withTranslation()->select(['slug', 'id'])->get();
        });




        view()->share('main_categories_home', $main_categories_home);
    }




}
