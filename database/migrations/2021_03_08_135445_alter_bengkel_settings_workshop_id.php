<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBengkelSettingsWorkshopId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bengkel_settings', function(Blueprint $table) {
            $table->dropForeign(['workshop_bengkel_id']);
            $table->foreign('workshop_bengkel_id')->references('id')->on('workshop_bengkels');
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
            $table->dropForeign(['workshop_bengkel_id']);
            $table->foreign('workshop_bengkel_id')->references('id')->on('menu_masters');
        });
    }
}
