<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOperOrder2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("oper_orders", function(Blueprint $table) {
            $table->integer("foreman_id", false, true)->nullable()->after("vehicle_type");
            $table->foreign("foreman_id")->references("id")->on("cms_users");
            $table->integer("service_advisor_id", false, true)->nullable()->after("vehicle_type");
            $table->foreign("service_advisor_id")->references("id")->on("cms_users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("oper_orders", function(Blueprint $table) {
            $table->dropForeign("oper_orders_foreman_id_foreign");
            $table->dropColumn("foreman_id");
            $table->dropForeign("oper_orders_service_advisor_id_foreign");
            $table->dropColumn("service_advisor_id");
        });
    }
}
