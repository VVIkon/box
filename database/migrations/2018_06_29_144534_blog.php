<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('blog_header', 255)->comment('Заголовок');
            $table->string('blog_img', 255)->comment('Картинка');
            $table->longText('bolg_content')->comment('Содержание');
            $table->string('blog_hashtags', 255)->nullable()->comment('ХешТеги');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_chat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id',false,true)->nullable()->comment('... к коментарию');
            $table->foreign('parent_id')->references('id')->on('blogs');

            $table->integer('blog_id',false,true)->comment('... к блогу');
            $table->foreign('blog_id')->references('id')->on('blogs');

            $table->integer('user_id',false,true)->comment('Комментатор');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('chat_comment')->comment('Коментарий');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_chat');
        Schema::dropIfExists('blogs');
    }
}
