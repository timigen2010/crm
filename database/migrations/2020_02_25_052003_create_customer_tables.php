<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->unsignedInteger('customer_group_id');
            $table->foreign('customer_group_id')
                ->references('customer_group_id')
                ->on('customer_groups');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique()->nullable();
            $table->boolean('newsletter');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->increments('customer_address_id');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->unsignedInteger('city_id');
            $table->string('address_1');
            $table->string('address_2');
            $table->boolean('is_main')->default(false);
        });

        Schema::create('customer_telephones', function (Blueprint $table) {
            $table->increments('customer_telephone_id');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->string('telephone');
            $table->boolean('is_main')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
        Schema::dropIfExists('customer_telephones');
        Schema::dropIfExists('customers');
    }
}
