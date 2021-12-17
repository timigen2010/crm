<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiscountCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_released_cards', function(Blueprint $table) {
            $table->string('discount_released_card_id')->primary();
        });

        Schema::create('discount_cards', function(Blueprint $table) {
            $table->string('discount_card_id')->primary();
            $table->foreign('discount_card_id')
                ->references('discount_released_card_id')
                ->on('discount_released_cards');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->unsignedInteger('customer_telephone_id');
            $table->foreign('customer_telephone_id')
                ->references('customer_telephone_id')
                ->on('customer_telephones');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->integer('confirm_code');
            $table->boolean('active');
            $table->boolean('blocked');
            $table->decimal('balance');
            $table->timestamp('date_released')->nullable();
            $table->timestamp('date_request')->nullable();
            $table->timestamp('date_activated')->nullable();
            $table->timestamp('date_blocked')->nullable();
        });

        Schema::create('discount_card_operations', function(Blueprint $table) {
            $table->increments('discount_card_operation_id');
            $table->string('discount_card_id');
            $table->foreign('discount_card_id')
                ->references('discount_card_id')
                ->on('discount_cards');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->string('type');
            $table->unsignedInteger('order_id')->nullable();
            $table->decimal('order_cost');
            $table->decimal('discount');
            $table->decimal('order_cost_discount');
            $table->decimal('bonus_use');
            $table->decimal('bonus_add');
            $table->timestamp('created_at');
            $table->text('comment');
            $table->string('telephone_old');
            $table->string('telephone_new');
        });

        Schema::create('discount_card_transactions', function(Blueprint $table) {
            $table->increments('discount_card_transaction_id');
            $table->string('discount_card_id');
            $table->foreign('discount_card_id')
                ->references('discount_card_id')
                ->on('discount_cards');
            $table->unsignedInteger('discount_card_operation_id');
            $table->foreign('discount_card_operation_id')
                ->references('discount_card_operation_id')
                ->on('discount_card_operations');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->timestamp('created_at');
            $table->decimal('amount');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_card_transactions');
        Schema::dropIfExists('discount_card_operations');
        Schema::dropIfExists('discount_cards');
        Schema::dropIfExists('discount_released_cards');
    }
}
