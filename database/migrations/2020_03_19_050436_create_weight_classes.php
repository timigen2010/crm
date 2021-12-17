<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_classes', function (Blueprint $table) {
            $table->increments('weight_class_id');
            $table->boolean('deleted');
            $table->float('value');
            $table->unsignedInteger('main_class_id')->nullable();
        });

        Schema::table('weight_classes', function (Blueprint $table) {
            $table->foreign('main_class_id')
                ->references('weight_class_id')
                ->on('weight_classes');
        });

        Schema::create('weight_class_descriptions', function (Blueprint $table) {
            $table->increments('weight_class_description_id');
            $table->unsignedInteger('weight_class_id');
            $table->foreign('weight_class_id')
                ->references('weight_class_id')
                ->on('weight_classes');
            $table->unsignedInteger('language_id');
            $table->string('title');
            $table->string('unit');
        });

//        Schema::table('products', function (Blueprint $table) {
//            $table->foreign('weight_class_id')
//                ->references('weight_class_id')
//                ->on('weight_classes');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('weight_class_id');
        });
        Schema::dropIfExists('weight_class_descriptions');
        Schema::dropIfExists('weight_classes');
    }
}
