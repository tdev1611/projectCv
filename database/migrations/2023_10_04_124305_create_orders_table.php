<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('info_id');
            $table->unsignedBigInteger('code_discount_id')->nullable();
            $table->decimal('total', 11, 2);
            $table->text('note')->nullable();
            $table->longText('items');
            $table->tinyInteger('status')->default(1)->comment('1: process, 2: successful; 3: failed');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('info_id')->references('id')->on('shipping_addresses')->onDelete('cascade');
            $table->foreign('code_discount_id')->references('id')->on('code_discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
