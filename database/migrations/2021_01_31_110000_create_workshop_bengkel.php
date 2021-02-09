<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopBengkel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_bengkels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bengkel_name', 45);
            $table->text('bengkel_alamat');
            $table->text('bengkel_long');
            $table->text('bengkel_lat');
            $table->tinyInteger('bengkel_status')
                ->comment('0: ACTIVE | 1: INACTIVE');
            $table->tinyInteger('bengkel_tipe')
                ->comment('1: BENGKEL RESMI | 2: BENGKEL UMUM');
            $table->date('created_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_bengkels');
    }
}
