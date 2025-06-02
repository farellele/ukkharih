<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\PKLController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/gurus', [GuruController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('gurus');

Route::get('/siswas', [SiswaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('siswas');

Route::get('/industris', [IndustriController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('industris');

Route::get('/industris/create_industris', [IndustriController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('industris.create_industri');

Route::post('/industris/store', [IndustriController::class, 'store'])
    ->name('industris.store');

Route::get('/pkl', [PKLController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('pkl');

Route::get('/pkl/create', [PKLController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('pkl.create');

Route::post('/pkl/store', [PKLController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('pkl.store');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';