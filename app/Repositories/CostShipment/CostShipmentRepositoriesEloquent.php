<?php

namespace App\Repositories\CostShipment;

use App\Models\CostShipment;

use App\Repositories\CostShipment\CostShipmentRepositoriesContract;
use App\Services\Shipment\ShipmentServicesContract;
use App\Jobs\ExecutionFileShipment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;


class CostShipmentRepositoriesEloquent implements CostShipmentRepositoriesContract
{

    public function __construct()
    {
        
    }


    public function saveCostShipment($costShipment, $allFilesWithoutExecution){
       
        $costShip = new CostShipment();

        $costShip->from_postcode = $costShipment[0];
        $costShip->to_postcode =  $costShipment[1];
        $costShip->from_weight = str_replace([',','.'],'',$costShipment[2]);
        $costShip->to_weight = str_replace([',','.'],'',$costShipment[3]);
        $costShip->cost = str_replace([',','.'],'',$costShipment[4]);
        $costShip->file_shipment_id = $allFilesWithoutExecution->id;        
        return $costShip->save();

    }

    public function updateExecuteCostShipment($allFilesWithoutExecution){
        $allFilesWithoutExecution->execute = 1;
        return $allFilesWithoutExecution->save();

    }
   
}
