<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('/login', 'login')->name('auth.request.login');
        Route::post('/register', 'register')->name('auth.request.register');
    });

    Route::controller(PageController::class)->group(function() {
        Route::get('/login', 'login')->name('auth.pages.login');
        Route::get('/register', 'register')->name('auth.pages.register');
    });
});

Route::controller(PageController::class)->group(function() {
    Route::fallback('notFound');
});


Route::middleware('auth')->group(function () {
    Route::controller(PageController::class)->group(function() {
        Route::get('/', 'dashboard')->name('dashboard');

        Route::get('/logs', 'log')->name('logs.pages.index');
    });

    Route::controller(AuthController::class)->group(function() {
        Route::delete('/logout', 'logout')->name('auth.request.logout');
    });

    Route::controller(ReservationController::class)->prefix('/reservations')->group(function() {
        Route::get('', 'index')->name('reservations.pages.index');
        Route::get('/create', 'create')->name('reservations.pages.create');
        Route::get('/edit/{reservation}')->name('reservations.pages.edit');
    });

    Route::controller(UserController::class)->prefix('/users')->group(function() {
        Route::get('', 'index')->name('users.pages.index');
    });

    Route::controller(LogController::class)->prefix('/logs')->group(function() {
        Route::get('', 'index')->name('logs.pages.index');
    });

    Route::controller(VehicleController::class)->prefix('/vehicles')->group(function() {
        Route::get('', 'index')->name('vehicles.pages.index');
        Route::get('/create', 'create')->name('vehicles.pages.create');
        Route::get('/edit/{vehicle}', 'edit')->name('vehicles.pages.edit');
        Route::post('', 'store')->name('vehicles.request.store');
        Route::put('/{vehicle}', 'update')->name('vehicles.request.update');
    });
});
