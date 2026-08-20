<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Gets all the routes for the TaskController and applies the auth and verified middleware to them
Route::resource('tasks', TaskController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
