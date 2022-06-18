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

    public function __construct(
        ShipmentRepositoriesContract $shipmentRepoContract,
        CostShipmentRepositoriesContract $costShipmentRepoContract,
        ExecutionFileShipment $jobShipment
    ) {
        $this->shipmentRepoContract = $shipmentRepoContract;
        $this->costShipmentRepoContract = $costShipmentRepoContract;
        $this->jobShipment = $jobShipment;
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

        if (!$this->shipmentRepoContract->saveUploadFile($fileModel)) {
            unlink($file);
            return new JsonResponse(['message' => 'Erro ao salvar o upload no banco de dados.'], 400);
        }

        return $this->createJobToExecution($fileModel);
    }


    public function getShipmentFiles()
    {
        return $this->shipmentRepoContract->getShipmentFiles();
    }

    public function createJobToExecution($fileModel)
    {
        return true;
    }


    public function readFileShipmentWithoutExecution()
    {

        $allFilesWithoutExecution = $this->shipmentRepoContract->getFilesWithoutExecution();        
        
        foreach ($allFilesWithoutExecution as $afw) {

            $file = fopen(public_path('uploads') . '/' . $afw->name, 'r');
         
            while (($open = fgetcsv($file, null, ';')) !== FALSE) {
              
                if($open[0]!='' && $open[0]!= 'from_postcode'){  
                                    
                    if(!$this->costShipmentRepoContract->saveCostShipment($open))
                        return new JsonResponse(['message' => 'Erro ao salvar o upload no banco de dados.'], 400);
                }

                    
            }

            fclose($file);
        }
    }
}
