<?php

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PemesananController;

Route::get('/', function () {
    return view('index');
});


Route::get('/aboutUs', [PemesananController::class, 'AboutUs'])->name('AboutUsCustomer');
Route::get('/ViewCO', [PemesananController::class, 'ViewCheckout'])->name('ViewCheckout');
Route::get('/kota/{provinsi_id}', [PemesananController::class, 'kota'])->name('kota');
Route::post('/checkout', [PemesananController::class, 'Co'])->name('checkout');
Route::post('/hitungOngkir', [PemesananController::class, 'hitungOngkir'])->name('hitungOngkir');
Route::get('/ContactUs', [PemesananController::class, 'Contact'])->name('ContactCustomer');
Route::get('/detail/{id}', [PemesananController::class, 'detail'])->name('detailProduct');
Route::get('/cartView', [PemesananController::class, 'cart'])->name('cartCustomer');
Route::get('/load-more-products', [ProdukController::class, 'loadMore'])->name('load.more');
Route::post('/cart', [PemesananController::class, 'add_chart'])->name('cart.add');
Route::post('/delete/{id}', [PemesananController::class, 'deleteCart'])->name('cart.delete');
Route::post('/Update', [PemesananController::class, 'CartUpdate'])->name('cart.update');
Route::post('/Payment', [PaymentController::class, 'processOrder'])->name('Payment');
Route::resource('/AdminPage', AdminController::class);
Route::resource('/Produk', ProdukController::class);
Route::resource('/Kategori', CategoryController::class);
Route::resource('/pemesanan', PemesananController::class);
