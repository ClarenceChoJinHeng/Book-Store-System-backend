<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;

// Route::post('/create', [AuthController::class, 'create']);
// Route::get('/read', [AuthController::class, 'read']);
// Route::get('/read-one/{id}', [AuthController::class, 'readOne']);
// Route::put('/update/{id}', [AuthController::class, 'update']);
// Route::delete('/delete/{id}', [AuthController::class, 'delete']);



Route::post('/register', [JWTAuthController::class, 'register']);
Route::post('/login', [JWTAuthController::class, 'login']);
Route::post('/addAuthor', [AuthorController::class, 'addAuthor']);
Route::get('/getAuthor', [AuthorController::class, 'readAuthor']);
Route::delete('/deleteAuthor/{id}', [AuthorController::class, 'deleteAuthor']);
Route::get('/getAuthorById/{id}', [AuthorController::class, 'getAuthorById']);
Route::put("/editAuthor/{id}", [AuthorController::class, 'editAuthor']);
Route::post("/addBook", [BookController::class, 'addBook']);
Route::get("/getBook", [BookController::class, 'getBook']);
Route::get("/getBookById/{id}", [BookController::class, 'getBookById']);
Route::put("/editBook/{id}", [BookController::class, 'editBook']);
Route::delete('/deleteBook/{id}', [AuthorController::class, 'deleteBook']);



Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/user', [JWTAuthController::class, 'getUser']);
    Route::post('/logout', [JWTAuthController::class, 'logout']);
    Route::post('/refresh', [JWTAuthController::class, 'refresh']);
});
