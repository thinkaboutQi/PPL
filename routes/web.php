<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrisPayController;
use App\Http\Controllers\SimpanAlamatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['login' => false, 'register' => false]);

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
});

// Checkout and order routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->middleware('auth')->name('checkout.process');
Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

Route::get('/order', [ProdukAirController::class, 'index'])->name('order');
Route::post('/order', [OrderController::class, 'store'])->name('checkout.store');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/order/{orderId}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');

// QRIS payment (dengan order_id)
Route::get('/order/qris-payment/{order_id}', [QrisPayController::class, 'showQRISPayment'])->name('order.qris-payment');

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
