<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Shipment\ShipmentRepositoriesContract;
use App\Repositories\Shipment\ShipmentRepositoriesEloquent;

class RepositorieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ShipmentRepositoriesContract::class, ShipmentRepositoriesEloquent::class);
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