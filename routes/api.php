<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Word;
use App\Http\Controllers\API\WordController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\API\LogController;

//Inicio de sesion y registro
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

//Obtencion de logs
Route::get('/logs', [LogController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {

    //Palabras
    Route::get('/words',[WordController::class, 'index']);
    Route::get('/words/{id}',[WordController::class, 'getWordById']);
    Route::get('/words/{categoryId}/{wordsCount}/{order}',[WordController::class, 'getWords']);
    Route::post('/words/{wordId}/verify-response', [WordController::class, 'verifyResponse']);

    //Categorias
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    
    //Respuestas
    Route::get('/responses/{word_id}', [ResponseController::class, 'getByWordId']);

    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
