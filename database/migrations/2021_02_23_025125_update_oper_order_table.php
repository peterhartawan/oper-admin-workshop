<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOperOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oper_orders', function (Blueprint $table) {
            $table->unsignedInteger('master_task')->nullable()->change();
            $table->unsignedInteger('bengkel_id')->nullable()->change();
            $table->unsignedInteger('vehicle_brand')->nullable()->change();
            $table->unsignedInteger('vehicle_type')->nullable()->change();
            $table->string('vehicle_plat', 15)->nullable()->change();
            $table->string('customer_name', 45)->nullable()->change();
            $table->string('customer_hp', 15)->nullable()->change();
            $table->string('customer_email', 45)->nullable()->change();
            $table->text('customer_address')->nullable()->change();
            $table->text('customer_long')->nullable()->change();
            $table->text('customer_lat')->nullable()->change();
            $table->smallInteger('order_type')->nullable()
                ->comment('1: MOBIL | 2: MOTOR')->change();
            $table->string('pkb_nomer', 25)->nullable()->change();
            $table->smallInteger('pkb_enable')->nullable()
                ->comment('0: NO | 1: YES (Untuk menunjukkan atau mengirimkan PKB ke user atau tidak)')->change();
            $table->integer('pkb_estimation')->nullable()->change();
            $table->text('pkb_file')->nullable()->change();
            $table->string('booking_no', 10)->nullable()->change();
            $table->smallInteger('order_status')->nullable()
                ->comment('0: Menunggu Driver - Hit ke Oper Task | 1: Dapat Driver - Hit ke Oper Task | 2: Service Advisor Open Order | 3: Service Advisor Submit Upload PKB | 4: Foreman Task, Baca dari master task | 5: Service Advisor Invoice diupload ( Pembayaran ) | 6: Menunggu Driver - Hit ke Oper Task | 7: Dapat Driver dan Show Driver - Hit ke Oper Task')->change();
            $table->dateTime('booking_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
