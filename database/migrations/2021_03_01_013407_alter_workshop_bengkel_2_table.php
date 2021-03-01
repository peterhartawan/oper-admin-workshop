<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterWorkshopBengkel2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshop_bengkels', function(Blueprint $table) {
            $table->string('oper_task_username', 255)->nullable();
            $table->string('oper_task_password', 255)->nullable();
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
            $table->dropColumn('oper_task_username', 255)->nullable();
            $table->dropColumn('oper_task_password', 255)->nullable();
        });
    }
}
