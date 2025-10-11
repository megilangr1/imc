<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Livewire\Dummy;
use App\Livewire\Pengguna\MainIndex as PenggunaMainIndex;
use App\Livewire\Skpd\MainIndex as SkpdMainIndex;
use Illuminate\Support\Facades\Route;

// Frontend
Route::get('/', [MainController::class, 'main'])->name('main');

// Auth
// Auth Route
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

    Route::prefix('master-data')->middleware(['role:MeGGi|Administrator'])->group(function () {
        Route::get('/data-skpd', SkpdMainIndex::class)->name('skpd.index');
        Route::get('/data-pengguna', PenggunaMainIndex::class)->name('pengguna.index');
    });
});

Route::get('/dummy', Dummy::class)->name('dummy');
