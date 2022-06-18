<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Services\Shipment\ShipmentServicesContract;
use Illuminate\Http\Request;

class ShipmentFileController extends Controller
{
    protected $shipServiceContract;

    public function __construct(
        ShipmentServicesContract $shipServiceContract
    ) {
        $this->shipServiceContract = $shipServiceContract;
    }

    public function list(){
        return view('shipment/list');
    }


    public function shipment(){
        return view('shipment/import');
    }

}