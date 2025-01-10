<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "isbn",
        "title",
        "author",
        "publisher",
        "publicationDate",
        "edition",
        "language",
        "genre",
        "category",
        "stockQuantity",
        "price",
        "description",
        "ratingsReview",
        "status",
        "bookImage",
    ];
}
