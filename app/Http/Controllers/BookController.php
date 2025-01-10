<?php

namespace App\Http\Controllers;

use App\Models\Book;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function addBook(Request $request)
    {

        // Validate
        $request->validate([
            "isbn" => "required|string|regex:/^\d{10,13}$/",
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "publisher" => "required|string|max:255",
            "publicationDate" => "required|date",
            "edition" => "required|string|max:255",
            "language" => "required|string|max:155",
            "genre" => "required|string|max:100",
            "category" => "required|string|max:255",
            "stockQuantity" => "required|integer|min:0",
            "price" => "required|integer|min:0",
            "description" => "required|string|max:1000",
            "ratingsReview" => "nullable|string|max:255",
            "status" => "required|string|before_or_equal:today",
            "bookImage" => "required|string|max:255",
        ]);


        $book = new Book;
        $book->isbn = $request->input('isbn');
        $book->title = $request->input("title");
        $book->author = $request->input("author");
        $book->publisher = $request->input("publisher");
        $book->publicationDate = $request->input("publicationDate");
        $book->edition = $request->input("edition");
        $book->language = $request->input("language");
        $book->genre = $request->input("genre");
        $book->category = $request->input("category");
        $book->stockQuantity = $request->input("stockQuantity");
        $book->price = $request->input("price");
        $book->description = $request->input("description");
        $book->ratingsReview = $request->input("ratingsReview");
        $book->status = $request->input("status");
        $book->bookImage = $request->input("bookImage");
        $book->save();

        // Return a response to client side
        return response()->json($book, 200);
    }
    public function getBook(Request $request)
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    public function getBookById($id)
    {
        // Fetch all authors
        $book = Book::find($id);

        if ($book) {
            // Return the authors as an JSON response
            return response()->json($book, 200);
        } else {
            return response()->json(["message" => 'Book not found', 404]);
        }
    }
    public function editBook($id, Request $request)
    {
        // Find author by id
        $book = Book::find($id);

        // Check if author exists
        if ($book) {
            // Update the author's attributes
            $book->isbn = $request->input('isbn');
            $book->title = $request->input("title");
            $book->author = $request->input("author");
            $book->publisher = $request->input("publisher");
            $book->publicationDate = $request->input("publicationDate");
            $book->edition = $request->input("edition");
            $book->language = $request->input("language");
            $book->genre = $request->input("genre");
            $book->category = $request->input("category");
            $book->stockQuantity = $request->input("stockQuantity");
            $book->price = $request->input("price");
            $book->description = $request->input("description");
            $book->ratingsReview = $request->input("ratingsReview");
            $book->status = $request->input("status");
            $book->bookImage = $request->input("bookImage");

            $book->save();

            return response()->json($book, 200);
        } else {
            // Return 404 if not found
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    // Delete Author
    public function deleteBook($id)
    {
        // Find the author by ID
        $book = Book::find($id);

        // Check if the author exists
        if ($book) {
            // Delete the Author
            $book->delete();

            // Return success response
            return response()->json(['message' => ' Book deleted successfully'], 200);
        } else {
            // Return a 404 not found response if the author does not exist
            return response()->json(['message' => "Book not found"], 404);
        }
    }
}
