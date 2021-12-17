<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPhonelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_phonelines', function (Blueprint $table) {
            $table->increments('company_phoneline_id');
            $table->unsignedInteger('company_id');
            $table->string('keyword')->unique();
        });

        Schema::create('company_phoneline_descriptions', function (Blueprint $table) {
            $table->increments('company_phoneline_description_id');
            $table->unsignedInteger('company_phoneline_id');
            $table->foreign('company_phoneline_id')
                ->references('company_phoneline_id')
                ->on('company_phonelines');
            $table->unsignedInteger('language_id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_phonelines');
        Schema::dropIfExists('company_phoneline_descriptions');
    }
}
