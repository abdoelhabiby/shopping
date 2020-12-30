<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class FrontViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //------------------using in all view in front end -------------------


        $main_categories_home = Category::mainCategory()->with(['chields' => function($q){
            return $q->select(['parent_id','slug','id'])->whereHas('chields');
        }])->select(['slug','id'])->get();

        view()->share('main_categories_home', $main_categories_home);





    }
}
