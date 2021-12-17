<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dial_statuses', function (Blueprint $table) {
            $table->increments('dial_status_id');
            $table->string('code');
        });

        Schema::create('dial_status_descriptions', function (Blueprint $table) {
            $table->increments('dial_status_description_id');
            $table->unsignedInteger('dial_status_id');
            $table->foreign('dial_status_id')
                ->references('dial_status_id')
                ->on('dial_statuses');
            $table->unsignedInteger('language_id');
            $table->string('name');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dial_statuses');
        Schema::dropIfExists('dial_status_descriptions');
    }
}
