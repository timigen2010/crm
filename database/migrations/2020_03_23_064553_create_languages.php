<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('language_id');
            $table->string('name');
            $table->string('code');
            $table->string('locale');
            $table->string('image');
            $table->boolean('status');
            $table->boolean('deleted');
        });

        Schema::table('user_permission_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('company_phoneline_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('weight_class_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('unit_class_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('customer_group_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('product_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('currency_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });

        Schema::table('company_descriptions',  function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_permission_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('company_phoneline_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('weight_class_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('unit_class_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('customer_group_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('product_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('currency_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::table('company_descriptions',  function (Blueprint $table) {
            $table->dropForeign('language_id');
        });
        Schema::dropIfExists('languages');
    }
}
