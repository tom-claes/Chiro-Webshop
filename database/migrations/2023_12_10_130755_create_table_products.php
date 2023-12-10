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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('size_sort');
            $table->float('price');
            $table->string('img');
            $table->unsignedBigInteger('category');
            $table->timestamps();

            $table->foreign('category')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('size_sort')->references('id')->on('size_sorts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
