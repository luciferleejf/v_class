<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviserArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adviser_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department')->default(0)->comment('部门');
            $table->string('cnName')->default('')->comment('中文名');
            $table->string('enName')->default('')->comment('英文名');
            $table->string('sex')->default('')->comment('性别');
            $table->string('area')->default('')->comment('地区');
            $table->string('phone')->default('')->comment('电话');
            $table->string('email')->default('')->comment('邮箱');
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
        Schema::drop('adviser_article');
    }
}