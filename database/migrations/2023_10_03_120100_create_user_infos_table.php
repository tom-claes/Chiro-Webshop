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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('bio');
            $table->string('hobby')->nullable();
            $table->string('pet')->nullable();
            $table->string('language');
            $table->string('residence');
            $table->string('interest')->nullable();
            $table->string('toy')->nullable();
            $table->string('food')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hobby')->references('hobby')->on('hobbies');
            $table->foreign('pet')->references('pet')->on('pets');
            $table->foreign('language')->references('language')->on('languages');
            $table->foreign('residence')->references('residence')->on('residences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};

