<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // 问题标题
            $table->text('body'); // 问题内容
            $table->integer('user_id')->unsigned(); // 发布者ID
            $table->integer('comments_count')->default(0);  // 评论量
            $table->integer('followers_count')->default(1); // 关注量
            $table->integer('answers_count')->default(0); // 答案量
            $table->smallInteger('close_comment')->default(0); // 是否关闭评论
            $table->smallInteger('is_hidden')->default(0); // 是否隐藏
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
        Schema::dropIfExists('questions');
    }
}
