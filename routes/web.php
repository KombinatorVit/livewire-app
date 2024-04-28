<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->name('profile');

Route::get('/tasks', \App\Livewire\Tasks\TasksIndex::class)

    ->name('tasks');

require __DIR__.'/auth.php';
