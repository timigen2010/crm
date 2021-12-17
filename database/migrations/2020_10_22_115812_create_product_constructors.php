<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductConstructors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_constructors', function (Blueprint $table) {
            $table->increments('product_constructor_id');
            $table->unsignedInteger('main_product_id');
            $table->unsignedInteger('basis_category_id');
            $table->unsignedInteger('sauce_category_id');
            $table->boolean('status');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });

        Schema::create('product_constructors_to_toppings', function (Blueprint $table) {
            $table->unsignedInteger('product_constructor_id');
            $table->unsignedInteger('topping_category_id');
        });

        Schema::create('product_constructors_to_companies', function (Blueprint $table) {
            $table->unsignedInteger('product_constructor_id');
            $table->unsignedInteger('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_constructors');
        Schema::dropIfExists('product_constructors_to_toppings');
    }
}
