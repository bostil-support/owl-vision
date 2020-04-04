<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->unsignedDecimal('price')->default(0);
            $table->integer('stock_quantity')->default(0);
            $table->enum('product_type', Product::PRODUCT_TYPES)
                ->default(Product::DEFAULT_PRODUCT_TYPE);
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')
                ->on('images')->onDelete('set null');
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->text('admin_comment')->nullable();
            $table->boolean('show_on_home_page')->default(false);
            $table->json('tags')->nullable();
            $table->string('manufacturer_part_number')->nullable();
            $table->boolean('published')->default(false);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
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
        Schema::dropIfExists('products');
    }
}
