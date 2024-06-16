<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\resellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\kelolapesananController;
use App\Http\Controllers\kelolaresellerController;
use App\Http\Controllers\kelolapersediaanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\resellercheckoutController;
use App\Http\Controllers\ResellerProdukController;

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
    return view('login');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');


Route::post('/login', 'App\Http\Controllers\AuthController@login');


Route::get('/register', function () {
    return view('register');
})->name('registerPage');

Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register');

// Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
// Route::get('/admin/persediaan/index', [kelolapersediaanController::class, 'index'])->name('persediaan.dashboard');
// Route::get('/admin/pesanan/index', [kelolapesananController::class, 'index'])->name('pesanan.dashboard');



// route::get('/admin/laporan/index', [laporanController::class, 'index'])->name('laporan.dashboard');
// route::get('admin/checkout/index', [checkoutController::class, 'index'])->name('checkout.dashboard');

// route::get('reseller/dashboard', [resellerController::class, 'index'])->name('reseller.dashboard');
// route::get('reseller/checkout/index', [resellercheckoutController::class, 'index'])->name('resellercheckout.dashboard');

// route::post('admin/persediaan/index', [kelolapersediaanController::class, 'store'])->name('barang.store');
// route::get('admin/persediaan/tabel', [kelolapersediaanController::class, 'tabel'])->name('barang.tabel');






// //Reseller



//AdminRoute
Route::group(['prefix' => 'admin', 'middleware' => 'checkAdmin', 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    //PERSEDIAAN
    Route::get('/persediaan/input-barang', [kelolapersediaanController::class, 'index'])->name('admin.input-barang');
    route::post('/persediaan/input-barang', [kelolapersediaanController::class, 'store'])->name('admin.input-barang-store');
    route::get('/persediaan/tabel-barang', [kelolapersediaanController::class, 'tabel'])->name('admin.tabel-barang');

    route::post('/persediaan/tabel', [kelolapersediaanController::class, 'tambahStok'])->name('admin.tambah-stok');
    route::get('/persediaan/index/{id}', [kelolapersediaanController::class, 'indexupdate'])->name('admin.view-barang-update');
    route::put('/persediaan/index/{id}', [kelolapersediaanController::class, 'update'])->name('admin.barang-update');
    route::delete('/persediaan/index/{id}', [kelolapersediaanController::class, 'destroy'])->name('admin.barang-delete');

    route::get('/persediaan/brand', [BrandController::class, 'index'])->name('admin.brand-view');
    route::post('/persediaan/brand', [BrandController::class, 'store'])->name('admin.brand-store');
    route::put('/persediaan/brand/{id}', [BrandController::class, 'update'])->name('admin.brand-update');
    route::delete('/persediaan/brand/{id}', [BrandController::class, 'destroy'])->name('admin.brand-delete');

    //RESSELER VERIFIKASI
    route::get('/reseller', [resellerController::class, 'index'])->name('admin.reseller-view');
    route::post('/reseller', [resellerController::class, 'store'])->name('admin.reseller-store');
    route::put('/reseller/{id}', [resellerController::class, 'updateStatus'])->name('admin.reseller.update-status');
    route::delete('/reseller/{id}', [resellerController::class, 'destroy'])->name('admin.reseller-delete');

    //PESANAN
    Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/pesanan/{id}', [PesananController::class, 'detail'])->name('admin.pesanan.detail');
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('admin.pesanan.update');

    //LAPORAN

    //KASIR
    Route::get('/kasir', [KasirController::class, 'index'])->name('admin.kasir');
    Route::post('/kasir', [KasirController::class, 'addToCart'])->name('admin.cart-add');
    Route::get('/checkout/{id}', [checkoutController::class, 'indexadmin'])->name('checkout-view-admin');
    Route::put('/checkout/{id}', [checkoutController::class, 'updateAdmin'])->name('checkout-admin');
});

Route::group(['prefix' => 'reseller', 'middleware' => 'auth', 'checkReseller'], function () {
    Route::get('/produk', [ResellerProdukController::class, 'index'])->name('reseller.produk');
});
//ResellerRoute
Route::group(['prefix' => 'reseller', 'middleware' => 'checkStatus', 'auth', 'checkReseller',], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'reseller'])->name('reseller.dashboard');

    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('reseller.cart');
    Route::post('/cart/{kode_barang}', [CartController::class, 'addToCart'])->name('reseller.cart-add');
    Route::put('/cart/{no_detail}', [CartController::class, 'update'])->name('reseller.cart-update');
    Route::delete('/cart/{no_detail}', [CartController::class, 'deleteFromCart'])->name('reseller.cart-delete');

    //Checkout
    Route::get('/checkout/{id}', [checkoutController::class, 'index'])->name('checkout-view');
    Route::put('/checkout/{id}', [checkoutController::class, 'update'])->name('checkout');

    //Pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('reseller.pembelian');
    Route::get('/pembelian/{id}', [PembelianController::class, 'detail'])->name('reseller.pembelian.detail');
    Route::post('/pembelian/{id}', [PembelianController::class, 'uploadBuktiBayar'])->name('reseller.pembelian.store');
    Route::put('/pembelian/{id}', [PembelianController::class, 'updateStatusDiterima'])->name('reseller.pembelian.update');
});
