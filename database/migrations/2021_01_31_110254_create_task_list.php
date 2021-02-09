<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_listes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_task_id');
            $table->foreign('master_task_id')->references('id')->on('task_masters');
            $table->string('list_name', 45);
            $table->tinyInteger('as_final_task')
                ->comment('NULL/0: TIDAK | 1: YES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_listes');
    }
}
