<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_classes', function (Blueprint $table) {
            $table->increments('unit_class_id');
            $table->boolean('deleted');
            $table->float('value');
            $table->unsignedInteger('main_class_id')->nullable();
        });

        Schema::table('unit_classes', function (Blueprint $table) {
            $table->foreign('main_class_id')
                ->references('unit_class_id')
                ->on('unit_classes');
        });

        Schema::create('unit_class_descriptions', function (Blueprint $table) {
            $table->increments('unit_class_description_id');
            $table->unsignedInteger('unit_class_id');
            $table->foreign('unit_class_id')
                ->references('unit_class_id')
                ->on('unit_classes');
            $table->unsignedInteger('language_id');
            $table->string('title');
            $table->string('unit');
        });

//        Schema::table('products', function (Blueprint $table) {
//            $table->foreign('unit_class_id')
//                ->references('unit_class_id')
//                ->on('unit_classes');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_classes');
        Schema::dropIfExists('unit_class_descriptions');
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('unit_class_id');
        });
    }
}
