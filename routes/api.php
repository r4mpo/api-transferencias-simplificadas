<?php

use App\Http\Controllers\Operations\TransfersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AuthController::class)->prefix('user')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware(['token'])->group(function () {
        Route::get('show', 'show');
        Route::get('logout', 'logout');
    });
});

Route::middleware(['token'])->group(function () {
    Route::post('transfer', [TransfersController::class, 'send']);
});