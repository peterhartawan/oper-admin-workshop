<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name', 255);
            $table->string('menu_link', 255);
            $table->string('menu_icon', 255);
            $table->unsignedInteger('parent_menu')->nullable();
            $table->foreign('parent_menu')->references('id')->on('menu_masters');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_masters');
    }
}
