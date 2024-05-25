<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\resellerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kelolapesananController;
use App\Http\Controllers\kelolaresellerController;
use App\Http\Controllers\kelolapersediaanController;
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

    //RESSELER VERIFIKASI
    route::get('/reseller', [resellerController::class, 'index'])->name('admin.reseller-view');
    route::post('/reseller', [resellerController::class, 'store'])->name('admin.reseller-store');
    route::put('/reseller/{id}', [resellerController::class, 'update_status'])->name('admin.reseller.update-status');
});


//ResellerRoute
Route::group(['prefix' => 'reseller', 'middleware' => 'checkReseller', 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'reseller'])->name('reseller.dashboard');

    //CHECKOUT
    Route::get('/checkout', [resellercheckoutController::class, 'index'])->name('reseller.checkout');
    Route::post('/checkout', [resellercheckoutController::class, 'store'])->name('reseller.checkout-store');
    Route::get('/checkout/tabel', [resellercheckoutController::class, 'tabel'])->name('reseller.checkout-tabel');
    Route::get('/checkout/tabel/{id}', [resellercheckoutController::class, 'show'])->name('reseller.checkout-show');
    Route::put('/checkout/tabel/{id}', [resellercheckoutController::class, 'update'])->name('reseller.checkout-update');
    Route::delete('/checkout/tabel/{id}', [resellercheckoutController::class, 'destroy'])->name('reseller.checkout-delete');

    //Menu Pesanan
    Route::get('/produk', [ResellerProdukController::class, 'index'])->name('reseller.produk');
});
