<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickName')->default('')->comment('昵称');
            $table->string('mobile')->default('')->comment('手机');
            $table->string('pwd')->default('')->comment('密码');
            $table->string('face_img_b')->default('')->comment('头像大');
            $table->string('face_img_m')->default('')->comment('头像中');
            $table->string('face_img_s')->default('')->comment('头像小');
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
        Schema::drop('client');
    }
}
