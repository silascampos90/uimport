<?php

namespace App\Repositories\CostShipment;
use Illuminate\Http\Request;

interface CostShipmentRepositoriesContract
{     
   
    public function saveCostShipment($costShipment, $filesWithoutExecution);
    public function updateExecuteCostShipment($filesWithoutExecution);
    public function updateLastReadRowCostShipment($filesWithoutExecution, int $row);
    public function updateStatusCostShipment($filesWithoutExecution, $status);
 
}