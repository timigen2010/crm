<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->increments('customer_group_id');
            $table->unsignedInteger('company_id');
        });

        Schema::create('customer_group_descriptions', function (Blueprint $table) {
            $table->increments('customer_group_description_id');
            $table->unsignedInteger('customer_group_id');
            $table->foreign('customer_group_id')
                ->references('customer_group_id')
                ->on('customer_groups');
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
        Schema::dropIfExists('customer_groups');
        Schema::dropIfExists('customer_group_description_id');
    }
}
