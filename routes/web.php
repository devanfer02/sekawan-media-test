<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', 'login')->name('auth.request.login');
    Route::post('/register', 'register')->name('auth.request.register');
});

Route::controller(PageController::class)->group(function() {
    Route::get('/login', 'login')->name('auth.pages.login');
    Route::get('/register', 'register')->name('auth.pages.register');
    Route::fallback('notFound');
});

Route::middleware('auth')->group(function () {
    Route::controller(PageController::class)->group(function() {
        Route::get('/', 'dashboard')->name('dashboard');
    });
});
