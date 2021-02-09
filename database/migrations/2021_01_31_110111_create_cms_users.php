<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedInteger('bengkel_id')->nullable();
            $table->foreign('bengkel_id')->references('id')->on('workshop_bengkels');
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('email', 255);
            $table->string('phone', 15);
            $table->tinyInteger('status');
            $table->tinyInteger('is_bengkel_staff')
                ->comment('0: NO | 1: YES');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_users');
    }
}
