<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StreamDocumentController;
use App\Livewire\Dummy;
use App\Livewire\Pengguna\MainIndex as PenggunaMainIndex;
use Illuminate\Support\Facades\Route;

// Frontend
Route::get('/', [MainController::class, 'main'])->name('main');

// Auth
// Auth Route
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard')->middleware(['role:MeGGi|Administrator|Operator|Verifikator|Validator']);

    Route::prefix('master-data')->middleware(['role:MeGGi|Administrator'])->group(function () {
        Route::get('/data-pengguna', PenggunaMainIndex::class)->name('pengguna.index');
    });

    Route::get('/dummy', Dummy::class)->name('dummy');
});


// Public File
Route::get('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.view');
Route::post('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.download');

// Private File 
Route::match(['get', 'post'], '/private-file/{folder}/{filename}', [StreamDocumentController::class, 'getPrivateFile'])->name('private-file')->middleware(['auth', 'role:MeGGi|Administrator|Operator']);
