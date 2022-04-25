<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Front\HomeIndexContract;
use App\Contracts\Dashboard\ProductContract;
use App\Repositories\Front\HomeIndexRepository;
use App\Contracts\Dashboard\NotificationContract;
use App\Repositories\Dashboard\ProductRepository;
use App\Repositories\Dashboard\NotificationsRepository;

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
        NotificationContract::class  => NotificationsRepository::class,
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
