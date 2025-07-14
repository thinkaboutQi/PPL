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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HistoryAdminController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


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

Route::get('/order/status/{id}', [OrderController::class, 'checkStatus'])->name('order.checkStatus');
Route::post('/admin/order/kirim/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'kirim'])->name('admin.order.kirim');

// Route daftar invoice admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/invoice-list', function() {
        $orders = \App\Models\Order::with(['user'])->latest()->get();
        return view('dashboard.invoice-list', compact('orders'));
    })->name('admin.invoice.list');
});

// Route untuk admin kirim invoice ke user
Route::post('/admin/invoice/send/{order}', [App\Http\Controllers\Admin\OrderController::class, 'sendInvoice'])->name('admin.invoice.send');
// Route detail invoice admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/invoice/{order}', function($order) {
        $order = \App\Models\Order::with(['items.ProdukAir', 'user'])->findOrFail($order);
        return view('dashboard.invoice', compact('order'));
    })->name('admin.invoice.show');
});

// Route daftar invoice user (tampilan khusus invoice-user.blade.php)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/invoice-user', function() {
        $invoices = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
        return view('dashboard.invoice-user', compact('invoices'));
    })->name('user.invoice.user');
});
// Route lama tetap dipertahankan jika masih dipakai di tempat lain

// Route detail invoice user
Route::middleware(['auth'])->group(function () {
    Route::get('/user/invoice/{order}', function($order) {
        $order = \App\Models\Order::with(['items.ProdukAir', 'user'])->where('user_id', auth()->id())->findOrFail($order);
        return view('dashboard.invoice', compact('order'));
    })->name('user.invoice.show');
});
// Route report admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/report', function() {
        return view('dashboard.report');
    })->name('admin.report');
});
// Chat admin ke user
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/chat', function(Request $request) {
        return view('dashboard.chat-admin');
    })->name('admin.chat');
    Route::post('/admin/chat/send', function(Request $request) {
        Chat::create([
            'from_id' => auth()->id(),
            'to_id' => $request->to_id,
            'message' => $request->message,
        ]);
        return redirect()->route('admin.chat', ['user_id' => $request->to_id]);
    })->name('admin.chat.send');
});
// Chat user ke admin
Route::middleware(['auth'])->group(function () {
    Route::get('/user/chat', function() {
        return view('dashboard.chat-user');
    })->name('user.chat');
    Route::post('/user/chat/send', function(\Illuminate\Http\Request $request) {
        \App\Models\Chat::create([
            'from_id' => auth()->id(),
            'to_id' => $request->to_id,
            'message' => $request->message,
        ]);
        return redirect()->route('user.chat', ['admin_id' => $request->to_id]);
    })->name('user.chat.send');
});