<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Services\Shipment\ShipmentServicesContract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShipmentFileController extends Controller
{

     /**
     * @var ShipmentServicesContract
     */
    protected $shipServiceContract;

    /**
     * @param ShipmentServicesContract $shipServiceContract
     */
    public function __construct(
        ShipmentServicesContract $shipServiceContract
    ) {
        $this->shipServiceContract = $shipServiceContract;
    }

     /**
     * @return View
     */
    public function list()
    {
        $filesShipment = $this->shipServiceContract->getShipmentFiles();
        return view('shipment/list', compact('filesShipment'));
    }

    /**
     * @return View
     */
    public function shipment()
    {
        return view('shipment/import');
    }

    /**
     * Upload file from server
     * @param Request $request
     * @return mixed
     */
    public function uploadFile(Request $request)
    {
        try {

            return $this->shipServiceContract->uploadFile($request);
        } catch (Throwable $e) {

            return new JsonResponse(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Execution files pending
     */
    public function getFilesWithoutExecution()
    {
        DB::beginTransaction();
        try {

            $fileUpdated = $this->shipServiceContract->readFileShipmentWithoutExecution();

            DB::commit();

            return $fileUpdated;
        } catch (Throwable $e) {
            DB::rollback();
            return new JsonResponse(['message' => $e->getMessage()], 500);
        }
    }
}
