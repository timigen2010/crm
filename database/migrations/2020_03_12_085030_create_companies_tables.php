<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->integerIncrements('company_id');
            $table->boolean('is_admin');
            $table->string('url');
            $table->string('ssl');
        });

        Schema::create('company_settings', function (Blueprint $table) {
            $table->integerIncrements('company_setting_id');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('companies');
            $table->string('code');
            $table->string('key');
            $table->text('value');
            $table->boolean('is_serialized');
        });

        Schema::create('company_descriptions', function (Blueprint $table) {
            $table->increments('company_description_id');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('companies');
            $table->unsignedInteger('language_id');
            $table->string('name');
            $table->string('long_name');
            $table->string('keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_settings');
    }
}
