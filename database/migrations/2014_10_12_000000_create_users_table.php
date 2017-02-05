<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); // 用户名
            $table->string('email')->unique(); // 邮箱
            $table->string('password'); // 密码
            $table->string('avatar')->default('/img/avatars/default.png'); // 头像
            $table->string('confirmation_token'); // 邮箱验证token
            $table->smallInteger('is_active')->default(0); // 邮箱验证状态
            $table->integer('questions_count')->default(0); // 问题量
            $table->integer('answers_count')->default(0); // 回答量
            $table->integer('comments_count')->default(0); // 评论量
            $table->integer('favourites_count')->default(0);  // 收藏量
            $table->integer('likes_count')->default(0); // 点赞量
            $table->integer('followers_count')->default(0); // 关注量
            $table->integer('followings_count')->default(0); // 被关注量
            $table->json('setting')->nullable(); // 个人信息和设置
            $table->string('api_token');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
