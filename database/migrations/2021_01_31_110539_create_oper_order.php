<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oper_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_task');
            $table->foreign('master_task')->references('id')->on('task_masters');
            $table->unsignedInteger('bengkel_id');
            $table->foreign('bengkel_id')->references('id')->on('workshop_bengkels');
            $table->unsignedInteger('vehicle_brand');
            $table->foreign('vehicle_brand')->references('id')->on('master_brands');
            $table->unsignedInteger('vehicle_type');
            $table->foreign('vehicle_type')->references('id')->on('vehicle_names');
            $table->string('vehicle_plat', 15);
            $table->string('customer_name', 45);
            $table->string('customer_hp', 15);
            $table->string('customer_email', 45);
            $table->text('customer_address');
            $table->text('customer_long');
            $table->text('customer_lat');
            $table->tinyInteger('order_type')
                ->comment('1: MOBIL | 2: MOTOR');
            $table->string('pkb_nomer', 25);
            $table->tinyInteger('pkb_enable')
                ->comment('0: NO | 1: YES (Untuk menunjukkan atau mengirimkan PKB ke user atau tidak)');
            $table->integer('pkb_estimation');
            $table->text('pkb_file');
            $table->string('booking_no', 10);
            $table->tinyInteger('order_status')
                ->comment('0: Menunggu Driver - Hit ke Oper Task | 1: Dapat Driver - Hit ke Oper Task | 2: Service Advisor Open Order | 3: Service Advisor Submit Upload PKB | 4: Foreman Task, Baca dari master task | 5: Service Advisor Invoice diupload ( Pembayaran ) | 6: Menunggu Driver - Hit ke Oper Task | 7: Dapat Driver dan Show Driver - Hit ke Oper Task');
            $table->dateTime('booking_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oper_orders');
    }
}
