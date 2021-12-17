<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('order_status_id');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
            $table->string('name');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')
                ->references('company_id')
                ->on('companies');
            $table->unsignedInteger('menu_company_id');
            $table->foreign('menu_company_id')
                ->references('menu_id')
                ->on('menus');
            $table->unsignedSmallInteger('count_person')->default(0);
            $table->decimal('count_oddmoney');
            $table->decimal('count_uncash');
            $table->string('discount_card_id')->nullable();
            $table->foreign('discount_card_id')
                ->references('discount_card_id')
                ->on('discount_cards');
            $table->unsignedInteger('discount_card_transaction_id')->nullable();
            $table->foreign('discount_card_transaction_id')
                ->references('discount_card_transaction_id')
                ->on('discount_card_transactions');
            $table->decimal('count_bonus')->nullable();
            $table->decimal('count_bonus_add')->nullable();
            $table->decimal('count_voucher')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->unsignedInteger('last_editor_id')->nullable();
            $table->foreign('last_editor_id')
                ->references('user_id')
                ->on('users');
            $table->boolean('deleted');
            $table->string('delivery_method');
            $table->text('comment');
            $table->decimal('total');
            $table->unsignedInteger('order_status_id');
            $table->foreign('order_status_id')
                ->references('order_status_id')
                ->on('order_statuses');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages');
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id')
                ->references('currency_id')
                ->on('currencies');
            $table->string('currency_code');
            $table->decimal('currency_value');
            $table->timestamps();
        });

        Schema::create('order_customers', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->primary();
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->primary();
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('coords')->nullable();
            $table->string('city')->nullable();
            $table->string('method');
            $table->string('code');
        });

        Schema::create('order_actions', function (Blueprint $table) {
            $table->increments('order_action_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->string('info');
            $table->timestamp('created_at');
        });

        Schema::create('order_cook_comments', function (Blueprint $table) {
            $table->increments('order_cook_comment_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->string('comment');
        });

        Schema::create('order_couriers', function (Blueprint $table) {
            $table->increments('order_courier_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('courier_id');
            $table->timestamp('created_at');
            $table->boolean('deleted');
        });

        Schema::create('order_delivery_times', function (Blueprint $table) {
            $table->increments('order_delivery_time_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->string('type');
            $table->string('day');
            $table->time('time');
        });

        Schema::create('order_histories', function (Blueprint $table) {
            $table->increments('order_history_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->unsignedInteger('order_status_id');
            $table->foreign('order_status_id')
                ->references('order_status_id')
                ->on('order_statuses');
            $table->text('comment');
            $table->timestamp('created_at');
            $table->binary('values');
        });

        Schema::create('order_key_serializes', function (Blueprint $table) {
            $table->increments('order_key_serialize_id');
            $table->string('column_id');
            $table->string('column_name');
        });

        Schema::create('order_carts', function (Blueprint $table) {
            $table->increments('order_cart_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('table_id');
            $table->json('cart');
            $table->timestamp('date_closed');
            $table->boolean('deleted');
            $table->string('status');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->timestamps();
        });

        Schema::create('order_options', function (Blueprint $table) {
            $table->increments('order_option_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('product_main_id');
            $table->foreign('product_main_id')
                ->references('product_id')
                ->on('products');
            $table->string('product_main_key');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
            $table->decimal('amount');
        });

        Schema::create('order_photos', function (Blueprint $table) {
            $table->increments('order_photo_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->string('photo');
            $table->timestamp('created_at');
            $table->boolean('deleted');
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('order_product_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
            $table->string('name');
            $table->decimal('amount');
            $table->unsignedInteger('unit_class_id');
            $table->foreign('unit_class_id')
                ->references('unit_class_id')
                ->on('unit_classes');
            $table->decimal('discount')->nullable();
            $table->string('discount_card_id')->nullable();
            $table->foreign('discount_card_id')
                ->references('discount_card_id')
                ->on('discount_cards');
            $table->unsignedInteger('currency_id');
            $table->foreign('currency_id')
                ->references('currency_id')
                ->on('currencies');
            $table->decimal('price');
            $table->decimal('total');
            $table->boolean('deleted');
        });

        Schema::create('order_reviews', function (Blueprint $table) {
            $table->increments('order_review_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->string('author');
            $table->text('text');
            $table->smallInteger('rating');
            $table->timestamps();
        });

        Schema::create('order_totals', function (Blueprint $table) {
            $table->increments('order_total_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->string('code');
            $table->string('title');
            $table->decimal('value');
        });

        Schema::create('order_tables', function (Blueprint $table) {
            $table->increments('order_table_id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
            $table->unsignedInteger('table_id');
            $table->boolean('deleted');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_totals');
        Schema::dropIfExists('order_reviews');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_photos');
        Schema::dropIfExists('order_options');
        Schema::dropIfExists('order_carts');
        Schema::dropIfExists('order_key_serializes');
        Schema::dropIfExists('order_histories');
        Schema::dropIfExists('order_delivery_times');
        Schema::dropIfExists('order_couriers');
        Schema::dropIfExists('order_cook_comments');
        Schema::dropIfExists('order_actions');
        Schema::dropIfExists('order_payments');
        Schema::dropIfExists('order_customers');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
    }
}
