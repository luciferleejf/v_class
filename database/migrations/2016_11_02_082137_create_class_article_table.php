<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tid')->default(0)->comment('授课老师');
            $table->integer('cid')->default(0)->comment('课程所属分类');
            $table->string('face_img')->default('')->comment('课程图片');

            $table->string('title')->default('')->comment('课程名称');
            $table->string('description')->default('')->comment('描述');
            $table->integer('type')->default(0)->comment('课程类型 0-视频 1-音频');
            $table->string('url')->default('')->comment('视频/音频 url');
            $table->integer('pre_class')->default(0)->comment('是否加入课程预告 0-不加入 1-加入');
            $table->string('pre_date')->default("")->comment('预告时间');
            $table->text('content')->default('')->comment('课程内容');
            $table->integer('click')->default(0)->comment('点击数');
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
        Schema::drop('class_article');
    }
}
