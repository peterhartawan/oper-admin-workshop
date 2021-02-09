<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBengkelSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bengkel_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('min_daily')
                ->comment('Minimal order setiap hari');
            $table->integer('maks_jarak');
            $table->time('min_order_time')
                ->comment('Minimal waktu order, contoh 2 jam sebelum nya atau 1 hari sebelumnya');
            $table->time('bengkel_open');
            $table->time('bengkel_close');
            $table->dateTime('last_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bengkel_settings');
    }
}
