<?php

namespace App\Repositories\CostShipment;
use Illuminate\Http\Request;

interface CostShipmentRepositoriesContract
{     
   
    public function saveCostShipment($costShipment, $allFilesWithoutExecution);
    public function updateExecuteCostShipment($allFilesWithoutExecution);
    public function updateLastReadRowCostShipment($allFilesWithoutExecution, int $row);
 
}