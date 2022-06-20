<?php

namespace App\Repositories\Shipment;

use App\Models\ShipmentFile;

use App\Repositories\Shipment\ShipmentRepositoriesContract;
use App\Jobs\ExecutionFileShipment;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ShipmentRepositoriesEloquent implements ShipmentRepositoriesContract
{

    /**
     * @param ShipmentFile $shipFile
     * @param ExecutionFileShipment $jobShipment
     */
    public function __construct(
        ShipmentFile $shipFile,
        ExecutionFileShipment $jobShipment
    ) {
        $this->shipFile = $shipFile;
        $this->jobShipment = $jobShipment;
    }

    /**
     * Move file to server
     * @param Request $request
     * @return ShipmentFile
     */
    public function uploadFile($request)
    {

        $shipFiles = new ShipmentFile();
        $shipFiles->name = time() . '-' . $request->file('importCsvFile')->getClientOriginalName();
        $shipFiles->size = number_format($request->file('importCsvFile')->getSize() / 1048576, 2);
        $shipFiles->date_import = Carbon::now();
        $shipFiles->status_id = 1;

        $request->file('importCsvFile')->move(public_path('uploads'), $shipFiles->name);

        return $shipFiles;
    }

    /**
     * Save file model to database
     * @param ShipmentFile $fileModel
     * @return boolean
     */
    public function saveUploadFile($fileModel)
    {
        return $fileModel->save();
    }

    /**
     * Get Shipment files paginate 10
     * @return Collection
     */
    public function getShipmentFiles()
    {
        return $this->shipFile->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Get files without execution
     * @return Collection
     */
    public function getFilesWithoutExecution()
    {
        return $this->shipFile->where('execute', 0)->first();
    }
}
