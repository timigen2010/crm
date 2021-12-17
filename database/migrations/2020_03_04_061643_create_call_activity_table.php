<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls_activity', function (Blueprint $table) {
            $table->increments('call_activity_id');
            $table->unsignedTinyInteger('source_type')->index();
            $table->unsignedInteger('source_id')->index();
            $table->string('source');
            $table->unsignedTinyInteger('destination_type')->index();
            $table->unsignedInteger('destination_id')->index();
            $table->string('destination');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('company_phoneline_id')->nullable();
            $table->foreign('company_phoneline_id')
                ->references('company_phoneline_id')
                ->on('company_phonelines');
            $table->string('phoneline')->nullable();
            $table->text('comment');
            $table->timestamp('date_start');
            $table->timestamp('date_end')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->unsignedInteger('duration_live')->nullable();
            $table->string('record')->nullable();
            $table->string('unique_id')->nullable();
            $table->unsignedSmallInteger('disposition')->nullable();
            $table->unsignedSmallInteger('status_dial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calls_activity');
    }
}
