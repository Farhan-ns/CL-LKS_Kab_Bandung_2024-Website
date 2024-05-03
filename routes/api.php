<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Middleware\AlwaysAcceptJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/products', ProductController::class);
    Route::get('/profile', ProfileController::class);

    Route::post('/transaction', [TransactionController::class, 'makeTransaction']);
});
