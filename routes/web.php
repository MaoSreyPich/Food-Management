<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= AUTH ==================
Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/add', [UserController::class, 'add'])->name('add');
Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');

// ================= ADMIN ==================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    // Manage Menu Overview (page to choose Category or Menu)
    Route::get('/manage-menu', function () {
        return view('admin.manage-menu');
    })->name('manage-menu');
    // Menu CRUD
    Route::resource('menu', App\Http\Controllers\Admin\MenuController::class);   
    // Category CRUD
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
});


// ================= CUSTOMER ==================
Route::middleware(['auth'])->prefix('user')->name('customer.')->group(function () {
    Route::get('/', [CustomerDashboard::class, 'index'])->name('dashboard');
});
