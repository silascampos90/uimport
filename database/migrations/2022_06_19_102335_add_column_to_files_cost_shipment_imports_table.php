<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToFilesCostShipmentImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files_cost_shipment_imports', function (Blueprint $table) {
            $table->Integer('line_read')->after('status_id')->default(1);
            $table->Integer('line_total')->after('line_read')->default(0);
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
            $table->dropColumn('line_read');
            $table->dropColumn('line_total');
        });
    }
}
