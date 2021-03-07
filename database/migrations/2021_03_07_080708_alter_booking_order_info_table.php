<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("booking_order_info", function(Blueprint $table) {
            $table->tinyInteger("order_state")
                ->comment('1: PICKUP ORDER (Untuk Order Status 0 sampai 1) |2: DELIVERY ORDER (Untuk Order Status 6 sampai 7)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("oper_orders", function(Blueprint $table) {
            $table->dropColumn("order_state");
        });
    }
}
