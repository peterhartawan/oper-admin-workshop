<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterWorkshopBengkelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshop_bengkels', function(Blueprint $table) {
            $table->tinyInteger('vehicle_type')->default(0)
                ->after('bengkel_status')
                ->comment('1: BENGKEL MOBIL| 2: BENGKEL MOTOR | 3: BENGKEL SEMUA KENDARAAN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshop_bengkels', function(Blueprint $table) {
            $table->dropColumn('vehicle_type');
        });
    }
}
