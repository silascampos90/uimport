<?php

namespace App\Repositories\Shipment;
use Illuminate\Http\Request;

interface ShipmentRepositoriesContract
{     
   
    public function uploadFile($request);
    public function saveUploadFile($fileModel);
    public function getShipmentFiles();
    
}