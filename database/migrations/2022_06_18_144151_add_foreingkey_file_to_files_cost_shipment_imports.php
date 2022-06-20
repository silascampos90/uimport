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
        Schema::table('coast_shipments', function (Blueprint $table) {

            $table->unsignedBigInteger('file_shipment_id')
            ->after('cost')
            ->nullable();

            $table->foreign('file_shipment_id')
            ->references('id')
            ->on('files_cost_shipment_imports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coast_shipments', function (Blueprint $table) {
            $table->dropForeign(['file_shipment_id']);
        });
    }
}
