<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Word;
use App\Http\Controllers\API\WordController;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::get('/categories', function () {
    $categories = Category::all();
    return response()->json($categories);
});

//Forma correcta
Route::get('/words/{categoryId}/{wordsCount}',[WordController::class, 'getWords']);

Route::get('/getWord/{id}',[WordController::class, 'getWordById']);


Route::post('/addCategory', [CategoryController::class, 'store']);

/*
Route::post('/logout', function (Request $request) {
    // Revoke the user's current token
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully'], 200);
});
*/

/*
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('token-api')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
});
*/

/*Route::post('/signup', function (Request $request) {
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Generate a Sanctum token for the new user
    $token = $user->createToken('token-api')->plainTextToken;

    // Return the token and user information
    return response()->json([
        'token' => $token,
        'user' => $user
    ], 201);
});*/