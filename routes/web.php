<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\StreamDocumentController;
use App\Livewire\Artikel\MainForm as ArtikelMainForm;
use App\Livewire\Artikel\MainIndex as ArtikelMainIndex;
use App\Livewire\Dummy;
use App\Livewire\Fe\Artikel\BacaArtikel;
use App\Livewire\Fe\Artikel\DaftarArtikel;
use App\Livewire\Fe\Main;
use App\Livewire\Fe\Produk\DaftarProduk;
use App\Livewire\Fe\Produk\DetailProduk;
use App\Livewire\Kategori\MainIndex as KategoriMainIndex;
use App\Livewire\Pengguna\MainIndex as PenggunaMainIndex;
use App\Livewire\Penjualan\MainForm as PenjualanMainForm;
use App\Livewire\Penjualan\MainIndex as PenjualanMainIndex;
use App\Livewire\Produk\MainForm as ProdukMainForm;
use App\Livewire\Produk\MainIndex as ProdukMainIndex;
use Illuminate\Support\Facades\Route;

// Frontend
Route::get('/', Main::class)->name('main');
Route::get('/katalog-produk', DaftarProduk::class)->name('katalog-produk');
Route::get('/produk/{slug}', DetailProduk::class)->name('detail-produk');

Route::get('/daftar-artikel', DaftarArtikel::class)->name('daftar-artikel');
Route::get('/artikel/{slug}', BacaArtikel::class)->name('baca-artikel');

// Auth
// Auth Route
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard')->middleware(['role:MeGGi|Administrator|Operator']);

    Route::prefix('master-data')->middleware(['role:MeGGi|Administrator'])->group(function () {
        Route::get('/data-pengguna', PenggunaMainIndex::class)->name('pengguna.index');
        Route::get('/data-kategori', KategoriMainIndex::class)->name('kategori.index');

        Route::prefix('data-produk')->name('produk.')->group(function () {
            Route::get('/', ProdukMainIndex::class)->name('index');
            Route::get('/tambah', ProdukMainForm::class)->name('create');
            Route::get('/ubah/{uuid}', ProdukMainForm::class)->name('edit');
        });

        Route::prefix('data-artikel')->name('artikel.')->group(function () {
            Route::get('/', ArtikelMainIndex::class)->name('index');
            Route::get('/tambah', ArtikelMainForm::class)->name('create');
            Route::get('/ubah/{uuid}', ArtikelMainForm::class)->name('edit');
        });
    });

    Route::prefix('penjualan')->name('penjualan.')->group(function () {
        Route::get('/', PenjualanMainIndex::class)->name('index');
        Route::get('/tambah', PenjualanMainForm::class)->name('create');
        Route::get('/ubah/{uuid}', PenjualanMainForm::class)->name('edit');

        Route::get('/cetak-invoice/{uuid}', [PrintController::class, 'cetakInvoice'])->name('cetak-invoice');
        Route::get('/cetak-kuitansi/{uuid}', [PrintController::class, 'cetakKuitansi'])->name('cetak-kuitansi');
    });

    Route::get('/dummy', Dummy::class)->name('dummy');
});

// Public File
Route::get('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.view');
Route::post('/public-file/{folder}/{filename}', [StreamDocumentController::class, 'getPublicFile'])->name('public-file.download');

// Private File 
Route::match(['get', 'post'], '/private-file/{folder}/{filename}', [StreamDocumentController::class, 'getPrivateFile'])->name('private-file')->middleware(['auth', 'role:MeGGi|Administrator|Operator']);
