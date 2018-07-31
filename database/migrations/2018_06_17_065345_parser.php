<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parser_id',false,true)->nullable()->comment('подсайт');
            $table->foreign('parser_id')->references('id')->on('parsers');

            $table->string('site_url', 255)->comment('Путь до сайта/страницы');
            $table->index('site_url','ind_site_url');
            $table->string('site_name', 255)->nullable()->comment('Наименование сайта/страницы');
            $table->longText('site_content')->comment('Содержание сайта/страницы');

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
        Schema::dropIfExists('parsers');
    }
}
