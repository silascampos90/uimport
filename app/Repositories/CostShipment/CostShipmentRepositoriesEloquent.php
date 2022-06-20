<?php

namespace App\Repositories\CostShipment;

use App\Models\CostShipment;

use App\Repositories\CostShipment\CostShipmentRepositoriesContract;


class CostShipmentRepositoriesEloquent implements CostShipmentRepositoriesContract
{

    /**
     * Save cost shipment
     * @param Array $costShipment
     * @param ShipmentFile $allFilesWithoutExecution
     * @return Collection
     */
    public function saveCostShipment($costShipment, $allFilesWithoutExecution)
    {
        $costShip = new CostShipment();
        $costShip->from_postcode = $costShipment[0];
        $costShip->to_postcode =  $costShipment[1];
        $costShip->from_weight = str_replace([',', '.'], '', $costShipment[2]);
        $costShip->to_weight = str_replace([',', '.'], '', $costShipment[3]);
        $costShip->cost = str_replace([',', '.'], '', $costShipment[4]);
        $costShip->file_shipment_id = $allFilesWithoutExecution->id;
        return $costShip->save();
    }

    /**
     * Update Execution file
     * @param ShipmentFile $allFilesWithoutExecution
     * @return boolean
     */
    public function updateExecuteCostShipment($allFilesWithoutExecution)
    {
        $allFilesWithoutExecution->execute = 1;
        $allFilesWithoutExecution->status_id = 3;
        return $allFilesWithoutExecution->save();
    }

    /**
     * Update last line executed
     * @param ShipmentFile $allFilesWithoutExecution
     * @param int $row
     * @return boolean
     */
    public function updateLastReadRowCostShipment($allFilesWithoutExecution, $row)
    {
        $allFilesWithoutExecution->line_read = $row;
        return $allFilesWithoutExecution->save();
    }

    /**
     * Update status execution file
     * @param ShipmentFile $allFilesWithoutExecution
     * @param int $row
     * @return boolean
     */
    public function updateStatusCostShipment($allFilesWithoutExecution, $row)
    {
        $allFilesWithoutExecution->status_id = $row;
        return $allFilesWithoutExecution->save();
    }
}
