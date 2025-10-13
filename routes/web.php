<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;

/*
|--------------------------------------------------------------------------
| Customer Pages
|--------------------------------------------------------------------------
*/
// Public homepage with navbar + login/register buttons
    Route::get('/', function () {
        return view('customer.home');
    });
    // Customer Auth
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/add', [UserController::class, 'add'])->name('add');
    Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');
    // Customer Dashboard (protected)
    Route::middleware(['auth'])->prefix('user')->name('customer.')->group(function () {
        Route::get('/', [CustomerDashboard::class, 'index'])->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Admin Pages
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/manage-menu', function () {
        return view('admin.manage-menu');
    })->name('manage-menu');
    // Menu & Categories CRUD
    Route::resource('menu', MenuController::class);   
    Route::resource('categories', CategoryController::class);
    // Orders CRUD
    Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::post('orders/{id}/status/{status}', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
    // User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}/toggle', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'You have been logged out.');
})->name('logout');
