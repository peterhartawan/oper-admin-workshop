<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOperOrdersFeedbackColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("oper_orders", function(Blueprint $table) {
            $table->text("feedback")->nullable();
            
            $table->boolean('order_status')
                ->nullable()
                ->comment('0: Menunggu Driver - Hit ke Oper Task | 1: Dapat Driver - Hit ke Oper Task | 2: Service Advisor Open Order | 3: Service Advisor Submit Upload PKB | 4: Foreman Task, Baca dari master task | 5: Service Advisor Invoice diupload ( Pembayaran ) | 6: Menunggu Driver - Hit ke Oper Task | 7: Dapat Driver dan Show Driver - Hit ke Oper Task | 8: Booking Selesai | -1: Booking Dibatalkan')
                ->change();
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
            $table->dropColumn("feedback");
        });
    }
}
