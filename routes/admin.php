<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| These routes are loaded by RouteServiceProvider with:
| - 'web' middleware group
| - 'auth' middleware
| - 'admin' middleware
| - '/admin' prefix
| - 'admin.' name prefix
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Categories management (to be expanded)
// Route::resource('categories', Admin\CategoryController::class);

// Products management (to be expanded)
// Route::resource('products', Admin\ProductController::class);

// Orders management (to be expanded)
// Route::resource('orders', Admin\OrderController::class);

// Customers management (to be expanded)
// Route::get('customers', [Admin\CustomerController::class, 'index'])->name('customers.index');

// Coupons management (to be expanded)
// Route::resource('coupons', Admin\CouponController::class);

// Reviews management (to be expanded)
// Route::resource('reviews', Admin\ReviewController::class);
