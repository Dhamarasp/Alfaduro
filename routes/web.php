<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/brand/create/store', [BrandController::class, 'store'])->name('brand.store');
Route::delete('/brand/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [CategoryController::class, 'create'])->name('kategori.create');
Route::post('/kategori/create/store', [CategoryController::class, 'store'])->name('kategori.store');
Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

Route::get('/barang', [ItemController::class, 'index'])->name('barang.index');
Route::get('/barang/show/{id}', [ItemController::class, 'show'])->name('barang.show');
Route::put('/barang/update/{id}', [ItemController::class, 'update'])->name('barang.update');
Route::get('/barang/create', [ItemController::class, 'create'])->name('barang.create');
Route::post('/barang/create/store', [ItemController::class, 'store'])->name('barang.store');
Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->name('barang.destroy');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
// Route::get('/barang/create', [ItemController::class, 'create'])->name('barang.create');
// Route::post('/barang/create/store', [ItemController::class, 'store'])->name('barang.store');
// Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->name('barang.destroy');

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

Route::get('/transaksi', function()
{
    return view('transaksi.index');
    
})->name('transaksi.index');




