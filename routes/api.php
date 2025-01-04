<?php

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

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/user', [JWTAuthController::class, 'getUser']);
    Route::post('/logout', [JWTAuthController::class, 'logout']);
    Route::post('/refresh', [JWTAuthController::class, 'refresh']);
});

// Admin
// Route::post('/book',[AuthController::class,'book']);
