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
        //
        Schema::create("books", function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('publicationDate');
            $table->string('edition');
            $table->string('language');
            $table->string('genre');
            $table->string('category');
            $table->integer('stockQuantity');
            $table->decimal('price', total: 8, places: 2);
            $table->string('description');
            $table->string('ratingsReview');
            $table->string('status');
            $table->string('bookImage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('books');
    }
};
