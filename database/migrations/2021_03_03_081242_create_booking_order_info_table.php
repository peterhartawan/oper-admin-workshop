<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_order_info', function (Blueprint $table) {
            $table->id();
            
            $table->string('booking_no')
                ->comment('Reference to booking_no in oper_orders');
            
            $table->integer('oper_task_order_id')
                ->comment('This parameter is used to save idorder parameters from Oper Task\'s create order response.');
            
            $table->string('oper_task_trx_id')
                ->comment('This parameter is used to save trx_id parameters from Oper Task\'s create order response.');        

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
        Schema::dropIfExists('booking_order_info');
    }
}
