<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->default('')->comment('手机');
            $table->string('verifyCode')->default('')->comment('验证码');
            $table->string('tag')->default('0')->comment('0-未验证 1-已验证');
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
        Schema::drop('verify_code');
    }
}
