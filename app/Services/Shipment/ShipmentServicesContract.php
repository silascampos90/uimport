<?php

namespace App\Services\Shipment;
use Illuminate\Http\Request;

interface ShipmentServicesContract
{     
      
    public function uploadFile($request);
    public function checkFileShipmentCost($fileName);
    public function getShipmentFiles();

    public function readFileShipmentWithoutExecution();
}