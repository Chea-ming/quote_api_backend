<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;


// Routes with public access

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/quotes/random', [QuoteController::class, 'random']);

// Routes with protected access

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/quotes', [QuoteController::class, 'index']);
    Route::post('/quotes', [QuoteController::class, 'store']);
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});