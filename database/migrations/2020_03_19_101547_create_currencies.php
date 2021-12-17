<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('currency_id');
            $table->unsignedInteger('main_currency_id')->nullable();
            $table->string('code');
            $table->integer('decimal_place');
            $table->decimal('value');
            $table->boolean('status');
            $table->boolean('deleted');
            $table->timestamps();
        });

//        Schema::table('currencies', function (Blueprint $table) {
//            $table->foreign('main_currency_id')
//                ->references('currency_id')
//                ->on('currencies');
//        });

        Schema::create('currency_descriptions', function (Blueprint $table) {
            $table->increments('currency_description_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('language_id');
            $table->foreign('currency_id')
                ->references('currency_id')
                ->on('currencies');
            $table->string('name');
            $table->string('symbol_left');
            $table->string('symbol_right');
        });

//        Schema::table('products', function (Blueprint $table) {
//            $table->foreign('currency_id')
//                ->references('currency_id')
//                ->on('currencies');
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
            $table->dropForeign('currency_id');
        });
        Schema::dropIfExists('currency_descriptions');
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropForeign('main_currency_id');
        });
        Schema::dropIfExists('currencies');
    }
}
