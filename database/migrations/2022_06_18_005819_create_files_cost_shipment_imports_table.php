<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesCostShipmentImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_cost_shipment_imports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('date_import');
            $table->string('size');
            $table->boolean('execute')->default(false);
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
       
        Schema::dropIfExists('files_cost_shipment_imports');
    }
}