<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_shipments', function (Blueprint $table) {
            $table->id();
            $table->string('from_postcode');
            $table->string('to_postcode');
            $table->Integer('from_weight');
            $table->Integer('to_weight');
            $table->Integer('cost');
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
        Schema::dropIfExists('cost_shipments');
    }
}
