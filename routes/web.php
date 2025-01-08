<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Models\DetailPengadaanBarang;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/merek', [BrandController::class, 'index'])->name('merek.index');
Route::get('/merek/create', [BrandController::class, 'create'])->name('merek.create');
Route::post('/merek/create/store', [BrandController::class, 'store'])->name('merek.store');
Route::delete('/merek/{merek}', [BrandController::class, 'destroy'])->name('merek.destroy');

Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [CategoryController::class, 'create'])->name('kategori.create');
Route::post('/kategori/create/store', [CategoryController::class, 'store'])->name('kategori.store');
Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
Route::post('/satuan/create/store', [SatuanController::class, 'store'])->name('satuan.store');
Route::delete('/satuan/{satuan}', [SatuanController::class, 'destroy'])->name('satuan.destroy');

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai/create/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/supplier/create/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

Route::get('/jenis-pembayaran', [JenisPembayaranController::class, 'index'])->name('jenispembayaran.index');
Route::get('/jenis-pembayaran/create', [JenisPembayaranController::class, 'create'])->name('jenispembayaran.create');
Route::post('/jenis-pembayaran/create/store', [JenisPembayaranController::class, 'store'])->name('jenispembayaran.store');
Route::delete('/jenis-pembayaran/{id}', [JenisPembayaranController::class, 'destroy'])->name('jenispembayaran.destroy');

Route::get('/barang', [ItemController::class, 'index'])->name('barang.index');
Route::get('/barang/show/{id}', [ItemController::class, 'show'])->name('barang.show');
Route::put('/barang/update/{id}', [ItemController::class, 'update'])->name('barang.update');
Route::get('/barang/create', [ItemController::class, 'create'])->name('barang.create');
Route::post('/barang/create/store', [ItemController::class, 'store'])->name('barang.store');
Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->name('barang.destroy');

Route::prefix('pengadaan')->group(function(){
    Route::get('/rencana', [PengadaanController::class, 'indexRencana'])->name('rencana.index');
    Route::post('/rencana/create/store', [PengadaanController::class, 'storeRencana'])->name('rencana.store');
    Route::post('/rencana/create/store/barang', [PengadaanController::class, 'storeBarangRencana'])->name('rencana.store.barang');
    Route::get('/rencana/show/{id}', [PengadaanController::class, 'showRencana'])->name('rencana.show');
    Route::get('/rencana/show/{id}/create', [PengadaanController::class, 'createBarangRencana'])->name('rencana.create');
    Route::post('/rencana/show/create/store', [PengadaanController::class, 'storeDetailBarangRencana'])->name('rencana.store.detailBarang');
    Route::delete('/rencana/{rencana}', [PengadaanController::class, 'destroyRencana'])->name('rencana.destroy');
    Route::delete('/rencana/show/{id}', [PengadaanController::class, 'destroyRencanaBarang'])->name('rencana.destroy.detailBarang');
    
    Route::get('/realisasi', [PengadaanController::class, 'indexRealisasi'])->name('realisasi.index');
    Route::get('/realisasi/show/{id}', [PengadaanController::class, 'showRealisasi'])->name('realisasi.show');
    Route::get('/realisasi/edit/{id}', [PengadaanController::class, 'editRealisasi'])->name('realisasi.edit');
    Route::put('/realisasi/update/{id}', [PengadaanController::class, 'updateRealisasi'])->name('realisasi.update');
    
    Route::get('/return', [PengadaanController::class, 'indexReturn'])->name('return.index');
    Route::post('/return/create/store', [PengadaanController::class, 'storeReturn'])->name('return.store');
    Route::get('/return/show/{id}', [PengadaanController::class, 'showReturn'])->name('return.show');
    Route::get('/return/show/{id}/create', [PengadaanController::class, 'createBarangReturn'])->name('return.create');
    Route::post('/return/show/create/store', [PengadaanController::class, 'storeDetailBarangReturn'])->name('return.store.detailBarang');
    
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
// Route::get('/barang/create', [ItemController::class, 'create'])->name('barang.create');
// Route::post('/barang/create/store', [ItemController::class, 'store'])->name('barang.store');
// Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->name('barang.destroy');

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::post('/transaksi/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
Route::get('/transaksi/show/{id}', [RiwayatController::class, 'show'])->name('transaksi.show');


