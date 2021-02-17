<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBengkelSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bengkel_settings', function(Blueprint $table) {
            $table->smallInteger('min_daily')->nullable()
                ->comment('Minimal order setiap hari')->change();
            $table->integer('maks_jarak')->nullable()->change();
            $table->time('min_order_time')->nullable()
                ->comment('Minimal waktu order, contoh 2 jam sebelum nya atau 1 hari sebelumnya')->change();
            $table->time('bengkel_open')->nullable()->change();
            $table->time('bengkel_close')->nullable()->change();
            $table->dateTime('last_update')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bengkel_settings', function(Blueprint $table) {
            $table->smallInteger('min_daily')->nullable(false)
                ->comment('Minimal order setiap hari')->change();
            $table->integer('maks_jarak')->nullable(false)->change();
            $table->time('min_order_time')->nullable(false)
                ->comment('Minimal waktu order, contoh 2 jam sebelum nya atau 1 hari sebelumnya')->change();
            $table->time('bengkel_open')->nullable(false)->change();
            $table->time('bengkel_close')->nullable(false)->change();
            $table->dateTime('last_update')->nullable(false)->change();
        });
    }
}
