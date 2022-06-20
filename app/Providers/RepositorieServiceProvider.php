<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Shipment\ShipmentRepositoriesContract;
use App\Repositories\Shipment\ShipmentRepositoriesEloquent;

use App\Repositories\CostShipment\CostShipmentRepositoriesContract;
use App\Repositories\CostShipment\CostShipmentRepositoriesEloquent;

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
        $this->app->singleton(CostShipmentRepositoriesContract::class, CostShipmentRepositoriesEloquent::class);
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