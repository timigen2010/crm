<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductComplects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_complects', function (Blueprint $table) {
            $table->integerIncrements('product_complect_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('material_id');
            $table->timestamp('date')->nullable();
            $table->decimal('price');
            $table->unsignedInteger('currency_id');
            $table->decimal('amount');
            $table->unsignedInteger('unit_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_complects');
    }
}
