<?php

namespace App\Services\Shipment;

use App\Models\ShipmentFile;
use App\Jobs\ExecutionFileShipment;
use App\Services\Shipment\ShipmentServicesContract;
use App\Repositories\Shipment\ShipmentRepositoriesContract;
use App\Repositories\CostShipment\CostShipmentRepositoriesContract;
use Illuminate\Http\JsonResponse;

class ShipmentServices implements ShipmentServicesContract
{

    /**
     * @var ShipmentRepositoriesContract
     */
    protected $shipmentRepoContract;

    /**
     * @var CostShipmentRepositoriesContract
     */
    protected $costShipmentRepoContract;

    const ENABLE_EXTENSION = ['csv'];
    const DEFAULT_FILE_HEADER = ['from_postcode', 'to_postcode', 'from_weight', 'to_weight', 'cost'];
    const LIMIT_ROW_EXECUTION = 3000;

    /**
     * @param ShipmentRepositoriesContract $shipmentRepoContract
     * @param CostShipmentRepositoriesContract $costShipmentRepoContract
     */
    public function __construct(
        ShipmentRepositoriesContract $shipmentRepoContract,
        CostShipmentRepositoriesContract $costShipmentRepoContract
    ) {
        $this->shipmentRepoContract = $shipmentRepoContract;
        $this->costShipmentRepoContract = $costShipmentRepoContract;
    }

    /**
     * Upload file from server
     * @param Request $request
     * @return mixed
     */
    public function uploadFile($request)
    {
        $extension = $request->file('importCsvFile')->getClientOriginalExtension();

        if (!in_array($extension, ShipmentServices::ENABLE_EXTENSION))
            return new JsonResponse(['message' => 'Apenas as extensões [' . implode(',', ShipmentServices::ENABLE_EXTENSION) . '] são permitidas.'], 400);

        return $this->checkFileShipmentCost($this->shipmentRepoContract->uploadFile($request));
    }

    /**
     * Check if the file is in default
     * @param ShipmentFile $fileModel
     * @return boolean
     */
    public function checkFileShipmentCost($fileModel)
    {
        $file = public_path('uploads') . '/' . $fileModel->name;
        $fileModel->line_total = count(file($file));

        if (($open = fopen($file, "r")) !== FALSE) {

            $fileHeader = explode(';', fgetcsv($open)[0]);
            $arrayDiff = array_diff($fileHeader, ShipmentServices::DEFAULT_FILE_HEADER);
            if ($arrayDiff) {
                fclose($open);
                unlink($file);
                return new JsonResponse(['message' => 'Arquivo fora do padrão'], 400);
            }
        }

        fclose($open);

        $fileUpdated = $this->shipmentRepoContract->saveUploadFile($fileModel);

        if (!$fileUpdated) {
            unlink($file);
            return new JsonResponse(['message' => 'Erro ao salvar o upload no banco de dados.'], 400);
        }

        ExecutionFileShipment::dispatch();

        return $fileUpdated;
    }

    /**
     * Catch unplayed files
     * @return mixed
     */

    public function getShipmentFiles()
    {
        return $this->shipmentRepoContract->getShipmentFiles();
    }

    /**
     * Upadate Status Cost file Shipment
     * @return mixed
     */

    public function updateStatusCostShipment($fileWithoutExecution, $status)
    {
        return $this->costShipmentRepoContract->updateStatusCostShipment($fileWithoutExecution, $status);
    }

    /**
     * Execution file and import to database
     * @return mixed
     */

    public function readFileShipmentWithoutExecution()
    {
        $fileWithoutExecution = $this->shipmentRepoContract->getFilesWithoutExecution();

        if ($fileWithoutExecution) {

            if (!$this->updateStatusCostShipment($fileWithoutExecution, 2))
                return new JsonResponse(['message' => 'Erro ao atualizar o status do file cost shipment.'], 400);

            $lineTotal = $fileWithoutExecution->line_read + ShipmentServices::LIMIT_ROW_EXECUTION;

            $lineTotal = $lineTotal >= $fileWithoutExecution->line_total ? $fileWithoutExecution->line_total : $lineTotal;

            $file = file(public_path('uploads') . '/' . $fileWithoutExecution->name);

            foreach ($file as $index => $row) if ($index++ < $lineTotal) {

                if ($index > $fileWithoutExecution->line_read) {

                    if (!$this->costShipmentRepoContract->saveCostShipment(explode(';', str_replace("\r\n", '', $row)), $fileWithoutExecution))
                        return new JsonResponse(['message' => 'Erro ao salvar o upload no banco de dados.'], 400);
                }
            }

            if (!$this->costShipmentRepoContract->updateLastReadRowCostShipment($fileWithoutExecution, $lineTotal))
                return new JsonResponse(['message' => 'Erro ao atualizar a última linha lida.'], 400);

            if ($lineTotal == $fileWithoutExecution->line_total) {
                if (!$this->costShipmentRepoContract->updateExecuteCostShipment($fileWithoutExecution))
                    return new JsonResponse(['message' => 'Erro ao atualizar Cost Shipment.'], 400);
            } else {
                ExecutionFileShipment::dispatch()->delay(now()->addSeconds(30));
            }
        }
    }
}
