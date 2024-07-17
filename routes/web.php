<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VehicleController;
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

Route::controller(PageController::class)->group(function() {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/reservations', 'reservation')->name('reservations.pages.index');
    Route::get('/logs', 'log')->name('logs.pages.index');
});

Route::controller(VehicleController::class)->prefix('/vehicles')->group(function() {
    Route::get('', 'index')->name('vehicles.pages.index');
    Route::get('/create', 'create')->name('vehicles.pages.create');
    Route::get('/edit/{vehicle}', 'edit')->name('vehicles.pages.edit');
    Route::post('', 'store')->name('vehicles.request.store');
    Route::put('/{vehicle}', 'update')->name('vehicles.request.update');
});

Route::middleware('auth')->group(function () {
});
