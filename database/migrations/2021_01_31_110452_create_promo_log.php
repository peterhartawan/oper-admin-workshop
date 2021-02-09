<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_promo_id');
            $table->foreign('master_promo_id')->references('id')->on('wa_promos');
            $table->string('sent_to', 20);
            $table->dateTime('sent_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_logs');
    }
}
