<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_system', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->tinyInteger('rating')
                ->comment('Only 1 to 5.');
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('oper_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_system');
    }
}
