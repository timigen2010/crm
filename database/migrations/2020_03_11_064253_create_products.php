<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('product_type_id');
            $table->string('type_code');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('product_type_id');
            $table->foreign('product_type_id')
                ->references('product_type_id')
                ->on('product_types');
            $table->string('name');
            $table->decimal('cost_price');
            $table->decimal('price');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('unit_class_id');
            $table->decimal('weight');
            $table->unsignedInteger('weight_class_id');
            $table->decimal('minimum');
            $table->boolean('status');
            $table->boolean('sale_able');
            $table->integer('cooking_time');
            $table->timestamp('date_available')->nullable();
            $table->boolean('deleted');
            $table->unsignedInteger('main_category_id');
//            $table->foreign('main_category_id')
//                ->references('category_id')
//                ->on('categories');
            $table->timestamps();
        });

        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->increments('product_description_id');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
            $table->unsignedInteger('language_id');
            $table->unsignedInteger('company_id');
            $table->text('description');
            $table->text('seo_description');
            $table->text('meta_description');
            $table->string('meta_title');
            $table->string('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_descriptions');
    }
}
