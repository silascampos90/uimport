<?php

namespace App\Services\Shipment;

use App\Services\Shipment\ShipmentServicesContract;
use App\Repositories\Shipment\ShipmentRepositoriesContract;

class ShipmentServices implements ShipmentServicesContract {
    
    Protected $shipmentRepoContract;
    public function __construct(ShipmentRepositoriesContract $shipmentRepoContract)
    {
        $this->shipmentRepoContract = $shipmentRepoContract;
    }  
   

}