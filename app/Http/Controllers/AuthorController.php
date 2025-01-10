<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function addAuthor(Request $request)
    {
        // Validate
        $request->validate([
            "name" => "required|string|max:225",
            "penName" => "required|string|max:225",
            "phoneNumber" => "required|string|max:20",
            "age" => "required|integer|max:225",
            "religion" => "required|string|max:225",
            "biography" => "required|string",
        ]);

        $author = new Author;
        $author->name = $request->input('name');
        $author->penName = $request->input("penName");
        $author->phoneNumber = $request->input("phoneNumber");
        $author->age = $request->input("age");
        $author->religion = $request->input("religion");
        $author->biography = $request->input("biography");
        $author->save();

        // Return a response to client side
        return response()->json($author, 201);
    }

    // Fetching Author
    public function readAuthor(Request $request)
    {
        // Fetch all authors
        $authors = Author::all();
        // Return the authors as an JSON response
        return response()->json($authors, 200);
    }


    // Fetching Author
    public function getAuthorById($id)
    {
        // Fetch all authors
        $author = Author::find($id);

        if ($author) {
            // Return the authors as an JSON response
            return response()->json($author, 200);
        } else {
            return response()->json(["message" => 'Author not found', 404]);
        }
    }

    public function editAuthor($id, Request $request)
    {
        // Find author by id
        $author = Author::find($id);

        // Check if author exists
        if ($author) {
            // Update the author's attributes
            $author->name = $request->input('name');
            $author->penName = $request->input('penName');
            $author->phoneNumber = $request->input('phoneNumber');
            $author->age = $request->input('age');
            $author->religion = $request->input('religion');
            $author->biography = $request->input('biography');

            $author->save();

            return response()->json($author, 200);
        } else {
            // Return 404 if not found
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    // Delete Author
    public function deleteAuthor($id)
    {
        // Find the author by ID
        $author = Author::find($id);

        // Check if the author exists
        if ($author) {
            // Delete the Author
            $author->delete();

            // Return success response
            return response()->json(['message' => ' Author deleted successfully'], 200);
        } else {
            // Return a 404 not found response if the author does not exist
            return response()->json(['message' => "Author not found"], 404);
        }
    }
}
