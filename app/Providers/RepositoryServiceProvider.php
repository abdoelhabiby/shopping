<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Front\HomeIndexContract as FrontHomeIndexContract;
use App\Contracts\Dashboard\ProductContract;
use App\Repositories\Front\HomeIndexRepository as FrontHomeIndexRepository;
use App\Contracts\Dashboard\NotificationContract;
use App\Repositories\Dashboard\ProductRepository;
use App\Repositories\Dashboard\NotificationsRepository;
use App\Contracts\Dashboard\HomeIndexContract as DashboardHomeIndexContract;
use App\Repositories\Dashboard\HomeIndexRepository as DashboardHomeIndexRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    protected $repositories = [

        ProductContract::class  => ProductRepository::class,
        FrontHomeIndexContract::class  => FrontHomeIndexRepository::class,
        NotificationContract::class  => NotificationsRepository::class,
        DashboardHomeIndexContract::class  => DashboardHomeIndexRepository::class,
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
