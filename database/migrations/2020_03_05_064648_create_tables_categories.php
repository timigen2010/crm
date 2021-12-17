<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_badges', function (Blueprint $table) {
            $table->increments('category_badge_id');
            $table->string('code');
            $table->string('image');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->unsignedInteger('category_badge_id')->nullable();
            $table->foreign('category_badge_id')
                ->references('category_badge_id')
                ->on('category_badges')
                ->onDelete('set null');
            $table->boolean('status');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('category_images', function (Blueprint $table) {
            $table->increments('category_image_id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories');
            $table->string('image');
            $table->unsignedTinyInteger('image_type');
        });

        Schema::create('category_descriptions', function (Blueprint $table) {
            $table->increments('category_description_id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories');
            $table->unsignedInteger('language_id');
            $table->unsignedInteger('company_id');
            $table->string('name');
            $table->string('h1_title');
            $table->string('meta_title');
            $table->text('short_description');
            $table->text('description');
            $table->text('meta_description');
            $table->text('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_badges');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_images');
        Schema::dropIfExists('category_descriptions');
        Schema::dropIfExists('categories_hierarchy');
    }
}
