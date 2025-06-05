<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenenunController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\AdminLogin;
use App\Http\Middleware\PelangganLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/update-region', [RegionController::class, 'update']);
Route::get('/logout', [AuthController::class, 'logout'])->name('login');
Route::get('/signup', [AuthController::class, 'registrasi'])->name('signup');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/signup', [AuthController::class, 'registrasiPost'])->name('signup.post');

Route::get('/ajax-carilokasi', [AjaxController::class, 'lokasi'])->name('ajax.getLokasi');
Route::get('/ajax-cost', [AjaxController::class, 'cost'])->name('ajax.getCost');

Route::post('/profil/update', [AuthController::class, 'updateProfil'])->name('profil.update');
Route::post('/profil/ganti-password', [AuthController::class, 'gantiPassword'])->name('profil.password');

//For Pelanggan
Route::get('/profil', [HomeController::class, 'profil'])->name('profil')->middleware(PelangganLogin::class);
Route::get('/cart', [HomeController::class, 'cart'])->name('cart')->middleware(PelangganLogin::class);
Route::post('/cart', [TransaksiController::class, 'cartPost'])->name('cart.post')->middleware(PelangganLogin::class);
Route::post('/checkout', [TransaksiController::class, 'checkout'])->name('checkout')->middleware(PelangganLogin::class);
Route::post('/place-order', [TransaksiController::class, 'placeOrder'])->name('order.place')->middleware(PelangganLogin::class);
Route::post('/cart/delete', [HomeController::class, 'deleteCart'])->name('cart.delete')->middleware(PelangganLogin::class);
Route::post('/order/upload-bukti', [TransaksiController::class, 'uploadBukti'])->name('order.payment')->middleware(PelangganLogin::class);
Route::get('/order', [HomeController::class, 'listOrder'])->name('order.list')->middleware(PelangganLogin::class);
Route::get('/order/{id}', [HomeController::class, 'detailOrder'])->name('order.detail')->middleware(PelangganLogin::class);
Route::get('/penenun/{id}', [HomeController::class, 'lokasiPenenun'])->name('penenun.lokasi');

Route::middleware(AdminLogin::class)->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('admin');

    Route::get('/ganti-password', [DashboardController::class, 'gantiPassword'])->name('admin.ganti-password');

    Route::get('/penenun', [PenenunController::class, 'index'])->name('penenun.index');
    Route::post('/penenun/insert', [PenenunController::class, 'insert'])->name('penenun.insert');
    Route::post('/penenun/update', [PenenunController::class, 'update'])->name('penenun.update');
    Route::post('/penenun/delete', [PenenunController::class, 'delete'])->name('penenun.delete');
    Route::get('/hasil-tenun/{id}', [ProdukController::class, 'byPenenun'])->name('penenun.hasil');

    Route::get('/kategori', [ProdukController::class, 'kategori'])->name('kategori.index');
    Route::post('/kategori/insert', [ProdukController::class, 'insertKategori'])->name('kategori.insert');
    Route::post('/kategori/update', [ProdukController::class, 'updateKategori'])->name('kategori.update');
    Route::post('/kategori/delete', [ProdukController::class, 'deleteKategori'])->name('kategori.delete');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
    Route::get('/produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/produk/insert', [ProdukController::class, 'insert'])->name('produk.insert');
    Route::post('/produk/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/produk/delete', [ProdukController::class, 'delete'])->name('produk.delete');

    Route::get('/transaksi/butuh-verifikasi', [TransaksiController::class, 'needVerify'])->name('transaksi.verify');
    Route::get('/transaksi/butuh-kirim', [TransaksiController::class, 'needShipping'])->name('transaksi.ship');
    Route::get('/transaksi/dalam-pengiriman', [TransaksiController::class, 'onShipping'])->name('transaksi.shipping');
    Route::get('/transaksi/selesai', [TransaksiController::class, 'finished'])->name('transaksi.finished');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'detailTransaksi'])->name('transaksi.detail');
    Route::post('/transaksi/verifikasi', [TransaksiController::class, 'verifikasi'])->name('verifikasi.post');
    Route::post('/transaksi/kirim', [TransaksiController::class, 'kirim'])->name('transaksi.kirim');
    Route::post('/transaksi/selesaikan', [TransaksiController::class, 'finishing'])->name('transaksi.finish');

    Route::get('/laporan', [LaporanController::class, 'laporanPage'])->name('laporan');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.cetak-laporan');
});
