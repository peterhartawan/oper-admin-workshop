<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInvoiceFileOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_users', function (Blueprint $table){
            $table->text('zoom_key')->nullable();
            $table->text('zoom_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("cms_users", function(Blueprint $table) {
            $table->dropColumn('zoom_key');
            $table->dropColumn('zoom_secret');
        });
    }
}
