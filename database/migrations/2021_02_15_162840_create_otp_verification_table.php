<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 20);
            $table->string('otp_code', 6);
            
            $table->tinyInteger('otp_type', 4)
                ->comment('1: Register | 2: Login');

            $table->tinyInteger('attempt', 4)
                ->default(0)
                ->comment('OTP Attempt. If user want to make some custom settings thingy in the future, this column might be help.');

            $table->tinyInteger('is_sent', 4)
                ->default(0)
                ->comment('0: Not Sent| 1: Sent');

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
        Schema::dropIfExists('otp_verification');
    }
}
