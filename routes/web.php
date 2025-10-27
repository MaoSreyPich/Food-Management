<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ==========================
// Controllers
// ==========================
use App\Http\Controllers\UserController;

// Admin Controllers
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Customer Controllers
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ProfileController;
// ==========================
// Public Routes
// ==========================
Route::get('/', [CustomerMenuController::class, 'home']);

// ==========================
// Auth Routes
// ==========================
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/add', [UserController::class, 'add'])->name('add');
Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');

// ==========================
// Customer Routes
// ==========================
Route::prefix('customer')->name('customer.')->group(function () {
    // Menu browsing
    Route::get('/menu', [CustomerMenuController::class, 'index'])->name('menu.index');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add-ajax', [CartController::class, 'addAjax'])
    ->name('cart.add.ajax');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    // Orders
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');

    // Dashboard (requires login)
    Route::middleware(['auth'])->get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
});

// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Categories & Menus
        Route::resource('categories', CategoryController::class);
        Route::resource('menu', AdminMenuController::class);

        // Orders
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::post('orders/{id}/status/{status}', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

        // Users
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::post('/users/{id}/toggle', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
    });


// ==========================
// Profile Routes
// ==========================

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



// ==========================
// Logout Route
// ==========================
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'You have been logged out.');
})->name('logout');