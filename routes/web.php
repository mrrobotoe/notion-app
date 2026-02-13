<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('notes', NoteController::class);

    Route::patch('teams/{team}/set-current', [TeamController::class, 'setCurrent'])->name('teams.set-current');
});

require __DIR__.'/auth.php';
