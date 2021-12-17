<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCPFC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cpfc', function (Blueprint $table) {
            $table->integerIncrements('product_cpfc_id');
            $table->unsignedInteger('product_id');
            $table->decimal('calories');
            $table->decimal('protein');
            $table->decimal('fat');
            $table->decimal('carbs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cpfc');
    }
}
