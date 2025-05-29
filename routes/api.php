<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;

// Auth Routes (Register/Login)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    // Auth Routes (Logout/Me)
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
    // Product Routes
    Route::prefix('products')->group(function () {
        // User Accessible
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        // Accessible For Admin Only
        Route::middleware('IsAdmin')->group(function () {
            Route::post('/', [ProductController::class, 'store']);
            Route::post('/{id}', [ProductController::class, 'update']);
            Route::delete('/{id}', [ProductController::class, 'destroy']);
        });
    });
    // Review Routes
    Route::prefix('reviews')->group(function () {
        // Accessible For Admin Only
        Route::middleware('IsAdmin')->group(function () {
            Route::get('/', [ReviewController::class, 'index']);
        });
        // User Accessible
        Route::post('/', [ReviewController::class, 'store']);
        Route::post('/{id}', [ReviewController::class, 'update']);
        Route::delete('/{id}', [ReviewController::class, 'destroy']);
    });
});
