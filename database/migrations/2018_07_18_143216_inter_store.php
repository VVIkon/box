<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('property_name', 255)->comment('характеристика');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name', 255)->comment('сатегория продукта');
            $table->integer('active',false,true)->comment('активность');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id',false,true)->comment('категория');
            $table->foreign('category_id')->references('id')->on('cs_categories');

            $table->string('article', 50)->comment('артикул');
            $table->string('product_name', 255)->comment('продукт');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('cs_product_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id',false,true)->comment('продукт');
            $table->foreign('product_id')->references('id')->on('cs_products');

            $table->integer('property_id',false,true)->comment('свойство');
            $table->foreign('property_id')->references('id')->on('cs_properties');

            $table->string('product_value', 255)->nullable()->comment('значение характеристики');
            $table->text('product_comment')->nullable()->comment('описание');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_complects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id',false,true)->nullable()->comment('продукт');
            $table->foreign('product_id')->references('id')->on('cs_products');
            $table->string('complect_name', 255)->comment('комплект');
            $table->text('complect_description', 255)->nullable()->comment('описание комплекта');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_complect_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('complect_id',false,true)->nullable()->comment('комплект');
            $table->foreign('complect_id')->references('id')->on('cs_complects');

            $table->integer('property_id',false,true)->comment('свойство');
            $table->foreign('property_id')->references('id')->on('cs_properties');

            $table->string('complect_value', 255)->nullable()->comment('значение комплекта');
            $table->text('complect_comment')->nullable()->comment('описание');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name', 255)->nullable()->comment('логин');
            $table->string('fio', 255)->nullable()->comment('ФИО');
            $table->string('address', 255)->nullable()->comment('адрес');
            $table->string('phone', 255)->nullable()->comment('телефон');
            $table->string('email', 255)->nullable()->comment('email');
            $table->string('psw', 255)->nullable()->comment('пароль');
            $table->text('comment')->nullable()->comment('коментарий');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('cs_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number', 255)->comment('номер');

            $table->integer('client_id',false,true)->nullable()->comment('клиент');
            $table->foreign('client_id')->references('id')->on('cs_clients');

            $table->integer('operation_id')->comment('операция');
            $table->integer('status_id')->comment('статус');
            $table->float('total')->nullable()->comment('сумма по счету');
            $table->date('delivery_date')->comment('дата доставки');
            $table->string('delivery_address', 256)->comment('адрес доставки');
            $table->text('comment')->nullable()->comment('коментарий');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cs_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id',false,true)->nullable()->comment('клиент');
            $table->foreign('invoice_id')->references('id')->on('cs_invoices');

            $table->integer('complect_id',false,true)->nullable()->comment('комплект');
            $table->foreign('complect_id')->references('id')->on('cs_complects');

            $table->float('kolvo')->nullable()->comment('количество комплектов');
            $table->float('price')->nullable()->comment('цена комплекта');
            $table->text('detail_comment')->nullable()->comment('коментарий');

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
        Schema::dropIfExists('cs_invoice_details');
        Schema::dropIfExists('cs_invoices');
        Schema::dropIfExists('cs_clients');
        Schema::dropIfExists('cs_complect_properties');
        Schema::dropIfExists('cs_complects');
        Schema::dropIfExists('cs_product_properties');
        Schema::dropIfExists('cs_properties');
        Schema::dropIfExists('cs_products');
        Schema::dropIfExists('cs_categories');
    }
}
