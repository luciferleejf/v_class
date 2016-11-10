<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('')->comment('请求方式');
            $table->string('name')->default('')->comment('接口名称');
            $table->string('url')->default('')->comment('接口地址');
            $table->string('parms')->default('')->comment('参数列表');
            $table->string('parmsDetail')->default('')->comment('参数说明');
            $table->string('jason')->default('')->comment('jason列表');
            $table->string('jasonDetail')->default('')->comment('jason说明');
            $table->integer('requestNum')->default(0)->comment('接口请求次数');
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
        Schema::drop('api');
    }
}
