<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBengkelSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bengkel_settings', function(Blueprint $table) {
            $table->unsignedInteger('workshop_bengkel_id')
                ->after('id');
            $table->foreign('workshop_bengkel_id')->references('id')->on('menu_masters');
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
            $table->dropColumn('workshop_bengkel_id');
        });
    }
}
