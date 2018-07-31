<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galery_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',false,true)->comment('Владелец грппы');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('group_name', 255)->comment('Наименование');
            $table->string('group_comment', 255)->nullable()->comment('Описание');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('galeries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',false,true)->comment('Владелец картины');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('galery_group_id',false,true)->comment('Группа картин');
            $table->foreign('galery_group_id')->references('id')->on('galery_groups');
            $table->string('url_img', 255)->comment('Путь до картины');
            $table->text('comment')->nullable()->comment('Описание картины')	;
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
        Schema::dropIfExists('galeries');
    }
}
