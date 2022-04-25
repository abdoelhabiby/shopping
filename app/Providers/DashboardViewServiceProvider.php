<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class DashboardViewServiceProvider extends ServiceProvider
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

        //------------------using in view in backend end ----------------


        dd(admin());




    }
}
