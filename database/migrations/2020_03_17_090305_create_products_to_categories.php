<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_to_categories', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_to_categories');
    }
}
