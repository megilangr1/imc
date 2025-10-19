<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StreamDocumentController;
use App\Livewire\Dummy;
use App\Livewire\Pencairan\BarjasKontrak;
use App\Livewire\Pencairan\BarjasNonKontrak;
use App\Livewire\Pencairan\DaftarFormulir;
use App\Livewire\Pencairan\GajiJkkJkmBpjs;
use App\Livewire\Pencairan\HibahBansos;
use App\Livewire\Pencairan\MainDetail;
use App\Livewire\Pencairan\MainIndex as PencairanMainIndex;
use App\Livewire\Pencairan\TambahUang;
use App\Livewire\Pencairan\TunjanganKinerja;
use App\Livewire\Pencairan\UpGu;
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

    Route::prefix('pencairan')->middleware(['role:MeGGi|Administrator|Operator'])->name('pencairan.')->group(function () {
        Route::get('/', PencairanMainIndex::class)->name('index');
        Route::get('/formulir', DaftarFormulir::class)->name('create');

        Route::prefix('formulir')->group(function () {
            Route::prefix('/belanja-barang-dan-jasa-kontrak')->group(function () {
                Route::get('/', BarjasKontrak::class)->name('barjas-kontrak');
                Route::get('/{uuid}/ubah', BarjasKontrak::class)->name('barjas-kontrak.edit');
                Route::get('/{uuid}/detail', MainDetail::class)->name('barjas-kontrak.detail');
            });

            Route::get('/belanja-barang-dan-jasa-non-kontrak', BarjasNonKontrak::class)->name('barjas-non-kontrak');
            Route::get('/hibah-dan-bansos', HibahBansos::class)->name('hibah-bansos');
            Route::get('/tambah-uang', TambahUang::class)->name('tambah-uang');
            Route::get('/tunjangan-kinerja', TunjanganKinerja::class)->name('tunjangan-kinerja');
            Route::get('/gaji-jkk-jkm-bpjs', GajiJkkJkmBpjs::class)->name('gaji-jkk-jkm-bpjs');
            Route::get('/up-gu', UpGu::class)->name('up-gu');
        });
    });
});

Route::get('/dummy', Dummy::class)->name('dummy');

// Public File
Route::get('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.view');
Route::post('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.download');

// Private File 
Route::match(['get', 'post'], '/private-file/{folder}/{filename}', [StreamDocumentController::class, 'getPrivateFile'])->name('private-file')->middleware(['auth', 'role:MeGGi|Administrator|Operator']);
