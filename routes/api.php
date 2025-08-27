<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

// Публичные маршрты
Route::prefix('public')->group(function () {
    Route::get('/books', [\App\Http\Controllers\Api\Public\BookController::class, 'index']);
    Route::get('/books/{book}', [\App\Http\Controllers\Api\Public\BookController::class, 'show']);

    Route::get('/authors', [\App\Http\Controllers\Api\Public\AuthorController::class, 'index']);
    Route::get('/authors/{author}', [\App\Http\Controllers\Api\Public\AuthorController::class, 'show']);

    Route::get('/genres', [\App\Http\Controllers\Api\Public\GenreController::class, 'index']);
});

// Авторские маршруты
Route::prefix('author')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Api\Author\AuthController::class, 'login']);

    Route::middleware('auth:sanctum', 'author')->group(function () {
        Route::put('/profile', [\App\Http\Controllers\Api\Author\AuthorController::class, 'update']);
        Route::get('/books', [\App\Http\Controllers\Api\Author\BookController::class, 'index']);
        Route::put('/books/{book}', [\App\Http\Controllers\Api\Author\BookController::class, 'update']);
        Route::delete('/books/{book}', [\App\Http\Controllers\Api\Author\BookController::class, 'destroy']);

        Route::post('/logout', [\App\Http\Controllers\Api\Author\AuthController::class, 'logout']);
    });
});

// Админские маршруты
Route::prefix('admin')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login']);

    Route::middleware('auth:sanctum', 'admin')->group(function () {
        Route::apiResource('/authors', \App\Http\Controllers\Api\Admin\AuthorController::class);
        Route::apiResource('/books', \App\Http\Controllers\Api\Admin\BookController::class);
        Route::apiResource('/genres', \App\Http\Controllers\Api\Admin\GenreController::class);

        Route::post('/logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
    });
});
