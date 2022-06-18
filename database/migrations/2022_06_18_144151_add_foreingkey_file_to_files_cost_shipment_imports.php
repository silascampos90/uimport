<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingkeyFileToFilesCostShipmentImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files_cost_shipment_imports', function (Blueprint $table) {

            $table->unsignedBigInteger('coast_shipment_id')
            ->after('status_id')
            ->nullable();

            $table->foreign('coast_shipment_id')
            ->references('id')
            ->on('coast_shipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files_cost_shipment_imports', function (Blueprint $table) {
            $table->dropForeign(['coast_shipment_id']);
        });
    }
}
