<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Tasks\TasksIndex;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', TasksIndex::class)->name('tasks.index');
});

Route::get('auth/telegram/redirect', function () {
    return Socialite::driver('telegram')->redirect();
});

Route::get('auth/telegram/callback', function () {
    $telegramUser = Socialite::driver('telegram')->user();
    dd( $telegramUser);
    $user = \App\Models\User::updateOrCreate(
        ['telegram_id' => $telegramUser->getId()],
        ['telegram_id' => $telegramUser->getId(),
            'name' => $telegramUser->getNickname(),
            'email' => $telegramUser->getEmail() ?? $telegramUser->getId() . '@telegram.com',
        ]
    );

    auth()->login($user);

    return redirect()->route('tasks.index');
})->name('auth.telegram.callback');

require __DIR__ . '/auth.php';
