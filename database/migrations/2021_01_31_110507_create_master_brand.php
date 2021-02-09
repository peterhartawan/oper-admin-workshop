<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name', 45);
            $table->tinyInteger('brand_type')
                ->comment('1: MOBIL | 2" MOTOR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_brands');
    }
}
