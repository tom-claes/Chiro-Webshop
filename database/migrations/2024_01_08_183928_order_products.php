<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->string('order_nr');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('order_nr')->references('order_nr')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('size_id')->references('id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
