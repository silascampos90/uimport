<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Services\Shipment\ShipmentServicesContract;

class ShipmentController extends Controller
{
    /**
     * @var ShipmentServicesContract
     */
    protected $shipServiceContract;

    /**
     * @param ShipmentServicesContract $shipServiceContract
     */
    public function __construct(
        ShipmentServicesContract $shipServiceContract
    ) {
        $this->shipServiceContract = $shipServiceContract;
    }

    /**
     * get list files shipment paginate 10
     */
    public function getShipmentFiles()
    {
        return $this->shipServiceContract->getShipmentFiles();
    }
}
