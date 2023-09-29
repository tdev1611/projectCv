<?php

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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->unsignedBigInteger('category_product_id');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->text('desc');
            $table->string('images');
            $table->longText('list_image');
            $table->longText('detail');
            $table->tinyInteger('features');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');

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
