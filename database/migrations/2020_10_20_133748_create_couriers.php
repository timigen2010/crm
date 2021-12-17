<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->increments('courier_id');
            $table->string('name');
            $table->string('telephone');
            $table->decimal('percent');
            $table->boolean('deleted');
            $table->timestamps();
        });

        Schema::create('couriers_to_companies', function (Blueprint $table) {
            $table->unsignedInteger('courier_id');
            $table->foreign('courier_id')
                ->references('courier_id')
                ->on('couriers');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couriers');
        Schema::dropIfExists('couriers_to_companies');
    }
}
