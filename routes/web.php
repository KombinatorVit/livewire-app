<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/tasks', \App\Livewire\Tasks\TasksIndex::class)
    ->middleware(['auth'])
    ->name('tasks');

require __DIR__.'/auth.php';
