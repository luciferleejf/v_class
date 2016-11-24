<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img')->default('')->comment('图片地址');
            $table->string('show')->default('0')->comment('0-不显示 1显示');
            $table->string('type')->default('1')->comment('1-首页推荐位');
            $table->integer('sort')->default(0)->comment('排序');
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
        Schema::drop('recommend');
    }
}
