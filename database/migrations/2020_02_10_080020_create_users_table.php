<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('user_group_id');
            $table->foreign('user_group_id')->references('user_group_id')->on('user_groups');
            $table->unsignedInteger('parent_user_id')->nullable();
            $table->foreign('parent_user_id')->references('user_id')->on('users');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('salt')->nullable();
            $table->boolean('status');
            $table->boolean('hide_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
