<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes (prefix: /admin, middleware: web + auth + admin)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Categories CRUD
Route::resource('categories', CategoryController::class)->except(['show']);

// Products CRUD
Route::resource('products', ProductController::class)->except(['show']);

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

// Customers
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::patch('/customers/{user}/toggle', [CustomerController::class, 'toggleStatus'])->name('customers.toggle');

// Coupons CRUD
Route::resource('coupons', CouponController::class)->except(['show']);

// Reviews
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::patch('/reviews/{review}/toggle', [ReviewController::class, 'toggleApproval'])->name('reviews.toggle');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Subscribers
Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
Route::delete('/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
Route::get('/subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');

// Enquiries
Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
Route::get('/enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
Route::patch('/enquiries/{enquiry}/status', [EnquiryController::class, 'updateStatus'])->name('enquiries.status');
Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');

// Settings
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
