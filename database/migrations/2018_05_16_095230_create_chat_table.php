<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inter_chat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',false,true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('for_user_id',false,true);
            $table->foreign('for_user_id')->references('id')->on('users');
            $table->text('user_message');
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
        Schema::dropIfExists('inter_chat');
    }
}
