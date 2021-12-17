<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permission_descriptions', function (Blueprint $table) {
            $table->increments('user_permission_description_id');
            $table->unsignedInteger('user_permission_id');
            $table->foreign('user_permission_id')
                ->references('user_permission_id')
                ->on('user_permissions');
            $table->unsignedInteger('language_id')
                ->nullable();
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
        Schema::dropIfExists('user_permission_descriptions');
    }
}
