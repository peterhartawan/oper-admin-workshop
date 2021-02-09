<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_task', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_task_id');
            $table->foreign('master_task_id')->references('id')->on('task_masters');
            $table->unsignedInteger('bengkel_id');
            $table->foreign('bengkel_id')->references('id')->on('workshop_bengkels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_task');
    }
}
