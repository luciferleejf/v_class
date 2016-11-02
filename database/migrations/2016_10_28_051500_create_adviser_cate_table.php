<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviserCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adviser_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('分类关系');
            $table->string('name')->default('')->comment('分类名称');

            $table->string('description')->default('')->comment('描述');
            $table->tinyInteger('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态');
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
        Schema::drop('adviser_cate');
    }
}
