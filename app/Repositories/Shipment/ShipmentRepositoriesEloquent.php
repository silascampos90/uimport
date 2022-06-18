<?php

namespace App\Repositories\Shipment;

use App\Models\ShipmentFile;

use App\Repositories\Shipment\ShipmentRepositoriesContract;
use App\Services\Shipment\ShipmentServicesContract;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;


class ShipmentRepositoriesEloquent implements ShipmentRepositoriesContract
{

    public function __construct(ShipmentFile $shipFile){
        $this->shipFile = $shipFile;
    }
   

    public function uploadFile($request)
    {
        $shipFiles = new ShipmentFile();
        $shipFiles->name = time() . '-' . $request->file('importCsvFile')->getClientOriginalName();
        $shipFiles->size = number_format($request->file('importCsvFile')->getSize() / 1048576, 2);
        $shipFiles->date_import = Carbon::now();

        $request->file('importCsvFile')->move(public_path('uploads'), $shipFiles->name);

        return $shipFiles;
        
    }

    public function saveUploadFile($fileModel){
        return $fileModel->save();
    }

    public function getShipmentFiles(){
        
        return $this->shipFile->paginate(10);
    }
}