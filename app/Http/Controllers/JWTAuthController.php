<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rules\Password;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{

    public function register(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'username' => 'string|max:255|required|unique:users',
            'email' => 'unique:users|email|max:255|required',
            'password' => [Password::min(8), 'required'],
        ]);

        // Create a new user instance
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));

        // Save the user to the database
        $user->save();

        // Return a success response
        return response()->json([
            'message' => 'User registered successfully',
        ], 201);
    }
    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            return response()->json(compact('token')); // compact() makes an associative array and insert the value together with the token.
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    // Get authenticated user
    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    // User logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
