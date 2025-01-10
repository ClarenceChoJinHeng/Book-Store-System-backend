<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable =  [
        'name',
        "penName",
        "phoneNumber",
        "age",
        "religion",
        "biography"
    ];


    // Specify attribute casting
    protected $casts = [
        'age' => 'integer',
    ];


    // // Define relationships (example: an author has many books)
    // public function books()
    // {
    //     return $this->hasMany(Book::class);
    // }
}
