<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatSubscibeTeble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',false,true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('subscribe_user_id',false,true);
            $table->foreign('subscribe_user_id')->references('id')->on('users');
            $table->text('comment');
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
        Schema::dropIfExists('chat_subscribe');
    }
}
