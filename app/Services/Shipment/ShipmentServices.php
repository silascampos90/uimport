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

    protected $shipmentRepoContract;
    protected $costShipmentRepoContract;

    const enableExtension = ['csv'];
    const defaultFileHeader = ['from_postcode', 'to_postcode', 'from_weight', 'to_weight', 'cost'];
    const limitRowByExecution = 5000;

    public function __construct(
        ShipmentRepositoriesContract $shipmentRepoContract,
        CostShipmentRepositoriesContract $costShipmentRepoContract
    ) {
        $this->shipmentRepoContract = $shipmentRepoContract;
        $this->costShipmentRepoContract = $costShipmentRepoContract;
    }


    public function uploadFile($request)
    {
        $extension = $request->file('importCsvFile')->getClientOriginalExtension();

        if (!in_array($extension, ShipmentServices::enableExtension))
            return new JsonResponse(['message' => 'Apenas as extensões [' . implode(',', ShipmentServices::enableExtension) . '] são permitidas.'], 400);

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
            $arrayDiff = array_diff($fileHeader, ShipmentServices::defaultFileHeader);
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


    public function getShipmentFiles()
    {
        return $this->shipmentRepoContract->getShipmentFiles();
    }

    public function readFileShipmentWithoutExecution()
    {
        $fileWithoutExecution = $this->shipmentRepoContract->getFilesWithoutExecution();

        if ($fileWithoutExecution) {

            $lineTotal = $fileWithoutExecution->line_read + ShipmentServices::limitRowByExecution;

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
            }else{
                ExecutionFileShipment::dispatch();
            }
        }
    }
}
