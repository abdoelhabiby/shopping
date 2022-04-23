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
        // $ttl = 60 * 60 * 24;
        // $main_categories_home = Cache::remember('main_categories_views_shared', $ttl, function () {

            $main_categories_home =  Category::mainCategory()
            ->whereHas('subCategories',function($q){
                $q->whereHas('categories',function($category){
                    $category->where('is_active', true)->whereHas('products', function ($q) {
                        $q->active();
                    });
                });
            })
            ->with(['subCategories' => function ($query) {
                $query->whereHas('categories', function ($category) {
                    $category->where('is_active', true)->whereHas('products', function ($q) {
                        $q->active();
                    });
                })
                    ->with('categories:id,parent_id,slug')
                    ->select(['parent_id', 'slug', 'id']);
            }])
            ->select(['slug', 'id'])->get();


        // });








        view()->share('main_categories_home', $main_categories_home);
    }
}
