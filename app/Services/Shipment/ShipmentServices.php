<?php

namespace App\Services\Shipment;

use App\Models\ShipmentFile;
use App\Services\Shipment\ShipmentServicesContract;
use App\Repositories\Shipment\ShipmentRepositoriesContract;
use Illuminate\Http\JsonResponse;

class ShipmentServices implements ShipmentServicesContract
{

    protected $shipmentRepoContract;

    const enableExtension = ['csv'];
    const defaultFileHeader = ['from_postcode', 'to_postcode', 'from_weight', 'to_weight', 'cost'];

    public function __construct(ShipmentRepositoriesContract $shipmentRepoContract)
    {
        $this->shipmentRepoContract = $shipmentRepoContract;
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

        return $this->shipmentRepoContract->saveUploadFile($fileModel);
    }


    public function getShipmentFiles(){
        return $this->shipmentRepoContract->getShipmentFiles();
    }
}
