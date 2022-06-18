<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\ShipmentFile;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Shipment\ShipmentServices;

class ExecutionFileShipment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
   

    /**
     * @var shipmentServices
     */
    private $shipmentServices;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @param ShipmentServices $shipmentServices
     * @return void
     */
    public function handle(ShipmentServices $shipmentServices)
    {
        $this->shipmentServices = $shipmentServices;


        $this->shipmentServices->readFileShipmentWithoutExecution();
        
    }
}
