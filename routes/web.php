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
use App\Http\Controllers\OrderHistoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HistoryAdminController;
use App\Http\Controllers\DetailOrderController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['login' => false, 'register' => false]);

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');

    Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('register.admin');
    Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin.store');

    Route::get('/register/user', [RegisterController::class, 'showUserRegistrationForm'])->name('register.user');
    Route::post('/register/user', [RegisterController::class, 'registerUser'])->name('register.user.store');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/homeadmin', [App\Http\Controllers\AdminController::class, 'index'])->name('homeadmin');
    Route::get('/admin/history', [App\Http\Controllers\HistoryAdminController::class, 'index'])->name('admin.history');
    Route::get('/history', [OrderHistoryController::class, 'index'])->name('history');
    Route::get('/detailorder/{id}', [DetailOrderController::class, 'index'])->name('DetailOrder');
});

// Checkout and order routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    });

    Route::get('/user/dashboard', function () {
        return view('dashboard.user');
    })->name('user.dashboard');

    //Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


