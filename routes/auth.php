<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CreateUserController;

Route::middleware('guest')->group(function () {
    Route::get('register', [CreateUserController::class, 'create'])->name('register');
    Route::post('register', [CreateUserController::class, 'store'])->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});
