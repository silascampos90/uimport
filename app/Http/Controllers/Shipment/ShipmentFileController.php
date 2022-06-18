<?php

namespace App\Http\Controllers\Shipment;

use App\Models\ShipmentFile;
use App\Http\Controllers\Controller;
use App\Services\Shipment\ShipmentServicesContract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Throwable;
use Exception;

class ShipmentFileController extends Controller
{
    protected $shipServiceContract;

    public function __construct(
        ShipmentServicesContract $shipServiceContract
    ) {
        $this->shipServiceContract = $shipServiceContract;
    }

    public function list(){
        $filesShipment = $this->shipServiceContract->getShipmentFiles();
        return view('shipment/list', compact('filesShipment'));
    }


    public function shipment(){
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

}