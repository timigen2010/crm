<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbsync extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_sync', function (Blueprint $table) {
            $table->increments('db_sync_id');
            $table->string('table');
            $table->unsignedInteger('foreign_table_id');
            $table->unsignedInteger('table_id');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_sync');
        //
    }
}
