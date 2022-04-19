<?php

namespace App\Providers;

use App\Contracts\ProductContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Dashboard\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    protected $repositories = [
        // CategoryContract::class         =>          CategoryRepository::class,
        // AttributeContract::class        =>          AttributeRepository::class,
        // BrandContract::class            =>          BrandRepository::class,
        ProductContract::class          =>          ProductRepository::class,
        // OrderContract::class            =>          OrderRepository::class,
    ];




    public function register()
    {


        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }


        $this->app->bind(
            'App\Interfaces\Front\HomeRepositoryInterface',
            'App\Repositories\Front\HomeRepository'

        );




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
