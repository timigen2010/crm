<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integerIncrements('menu_id');
            $table->string('name');
        });

        Schema::create('menus_to_companies', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('companies');
        });

        Schema::create('categories_to_menus', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories');
        });

        Schema::create('products_to_menus', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menus_to_companies');
        Schema::dropIfExists('categories_to_menus');
        Schema::dropIfExists('products_to_menus');
    }
}
