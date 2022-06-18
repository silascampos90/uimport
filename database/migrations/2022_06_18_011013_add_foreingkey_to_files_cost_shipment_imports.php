<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeingkeyToFilesCostShipmentImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files_cost_shipment_imports', function (Blueprint $table) {

            $table->unsignedBigInteger('status_id')
            ->after('size')
            ->nullable();

            $table->foreign('status_id')
            ->references('id')
            ->on('status_imports');
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
            $table->dropForeign(['status_id']);
        });
    }
}