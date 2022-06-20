<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Services\Shipment\ShipmentServicesContract;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected $shipServiceContract;

    public function __construct(
        ShipmentServicesContract $shipServiceContract
    ) {
        $this->shipServiceContract = $shipServiceContract;
    }

    public function getShipmentFiles(){
        return $this->shipServiceContract->getShipmentFiles();
    }
}
