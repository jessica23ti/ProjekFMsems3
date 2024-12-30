<?php

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;



Route::middleware(['auth', 'verified'])->get('/', function () {
    return view('index');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    // Menampilkan tampilan verifikasi email
    Route::get('/email/verify', [EmailVerificationController::class, 'show'])
        ->name('verification.notice');

    // Verifikasi email
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    // Kirim ulang email verifikasi
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
        ->name('verification.resend');
});


// Rute login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::get('/register', [AuthenticatedSessionController::class, 'create'])
    ->name('register.show');

// Rute untuk post data login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register.create');

Route::get('/sukses', [PaymentController::class, 'getThanku'])->name('sukses');
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
Route::get('/PaymentView', [PaymentController::class, 'getViewPayment'])->name('PaymentView');
Route::post('/Order', [PaymentController::class, 'Order'])->name('Order');
Route::post('/PaymentUpdate', [PaymentController::class, 'processOrderUpdate'])->name('PaymentUpdate');
Route::resource('/AdminPage', AdminController::class);
Route::resource('/Produk', ProdukController::class);
Route::resource('/Kategori', CategoryController::class);
Route::resource('/pemesanan', PemesananController::class);
