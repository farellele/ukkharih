<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\DashboardController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Middleware untuk autentikasi & verifikasi pengguna
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Guru
    Route::get('/gurus', [GuruController::class, 'index'])->name('gurus');

    // Siswa
    Route::get('/siswas', [SiswaController::class, 'index'])->name('siswas');

    // Industri
    Route::prefix('industris')->group(function () {
        Route::get('/', [IndustriController::class, 'index'])->name('industris');
        Route::get('/industris/create_industris', [IndustriController::class, 'create'])->name('industris.create_industri');
        Route::post('/store', [IndustriController::class, 'store'])->name('industris.store');
    });

    // PKL
    Route::prefix('pkl')->group(function () {
        Route::get('/', [PKLController::class, 'index'])->name('pkl');
        Route::get('/pkl/create', [PKLController::class, 'create'])->name('pkl.create');
        Route::post('/pkl/store', [PKLController::class, 'store'])->name('pkl.store');
    });


    // Settings dengan Livewire Volt
    Route::prefix('settings')->group(function () {
        Route::redirect('/', 'settings/profile');
        Volt::route('profile', 'settings.profile')->name('settings.profile');
        Volt::route('password', 'settings.password')->name('settings.password');
        Volt::route('appearance', 'settings.appearance')->name('settings.appearance');
    });
});

// Load route autentikasi default Laravel
require __DIR__.'/auth.php';
