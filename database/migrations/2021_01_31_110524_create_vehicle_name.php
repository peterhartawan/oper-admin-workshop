<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_name', 45);
            $table->unsignedInteger('master_brand_id');
            $table->foreign('master_brand_id')->references('id')->on('master_brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_names');
    }
}
