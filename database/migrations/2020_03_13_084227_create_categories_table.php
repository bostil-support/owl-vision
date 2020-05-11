<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('template')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')
                ->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')
                ->on('images')->onDelete('set null');
            $table->unsignedInteger('page_size')->nullable();
            $table->boolean('allow_select_page_size')->default(true);
            $table->string('page_size_options')->nullable();
            $table->string('price_range')->nullable();
            $table->boolean('show_on_home_page')->default(true);
            $table->boolean('featured_on_home_page')->default(true);
            $table->boolean('show_on_search_box')->default(true);
            $table->unsignedInteger('search_box_order')->default(0);
            $table->boolean('show_on_top_menu')->default(true);
            $table->boolean('published')->default(false);
            $table->string('flag')->nullable();
            $table->string('flag_style')->nullable();
            $table->string('icon')->nullable();
            $table->integer('default_sort')->default(0);
            $table->boolean('hide_on_catalog')->default(false);
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
        Schema::dropIfExists('categories');
    }
}
