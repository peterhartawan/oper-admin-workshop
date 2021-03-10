<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskPogressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_progress', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('task_id');
            $table->timestamp("list_done")->nullable();

            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('oper_orders');
            
            $table->foreign('task_id')
                ->references('id')
                ->on('task_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_progress');
    }
}
