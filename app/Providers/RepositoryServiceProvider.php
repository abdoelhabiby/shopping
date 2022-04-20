<?php

namespace App\Providers;

use App\Contracts\ProductContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Front\HomeIndexContract;
use App\Repositories\Front\HomeIndexRepository;
use App\Repositories\Dashboard\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    protected $repositories = [

        ProductContract::class  => ProductRepository::class,
        HomeIndexContract::class  => HomeIndexRepository::class,
    ];




    public function register()
    {


        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
