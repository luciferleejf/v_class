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

            $table->integer('cid')->default(0)->comment('顾问所属分类');
            $table->string('adviser_img')->default("")->comment('顾问图片');
            $table->string('cnName')->default('')->comment('中文名');
            $table->string('enName')->default('')->comment('英文名');
            $table->string('sex')->default('')->comment('性别');
            $table->string('area')->default('')->comment('地区');
            $table->string('phone')->default('')->comment('电话');
            $table->integer('gold')->default(0)->comment('金牌顾问 0-普通 1-金牌');
            $table->string('job')->default('')->comment('职位');
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
