<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Word;
use App\Http\Controllers\API\WordController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthController;

//Inicio de sesion y registro
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //Palabras
    Route::get('/words',[WordController::class, 'index']);
    Route::get('/words/{id}',[WordController::class, 'getWordById']);
    Route::get('/words/{categoryId}/{wordsCount}',[WordController::class, 'getWords']);

    //Categorias
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    

    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
