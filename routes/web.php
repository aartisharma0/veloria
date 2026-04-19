<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\EnquiryController;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SubscriberController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Public & User)
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
Route::get('/search/autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::get('/contact', [EnquiryController::class, 'create'])->name('contact');
Route::post('/contact', [EnquiryController::class, 'store'])->name('contact.store');
Route::get('/shipping-delivery', [PageController::class, 'shipping'])->name('pages.shipping');
Route::get('/returns-exchanges', [PageController::class, 'returns'])->name('pages.returns');
Route::get('/size-guide', [PageController::class, 'sizeGuide'])->name('pages.size-guide');
Route::get('/faqs', [PageController::class, 'faqs'])->name('pages.faqs');
Route::get('/terms', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

// Bug #14: Handle GET /logout gracefully
Route::get('/logout', function () { return redirect()->route('login'); });

// Bug #9: /admin redirects to admin dashboard
Route::get('/admin', function () { return redirect()->route('admin.dashboard'); });

// Cart (no auth needed - session based)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::patch('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::delete('/coupon', [CartController::class, 'removeCoupon'])->name('coupon.remove');
});

// Auth required routes
Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Product review
    Route::post('/product/{product}/review', [ProductController::class, 'review'])->name('products.review');

    // Account
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
        Route::put('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [AccountController::class, 'changePassword'])->name('password.update');
        Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [AccountController::class, 'orderDetail'])->name('orders.show');
        Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
        Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
        Route::put('/addresses/{address}', [AccountController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('/addresses/{address}', [AccountController::class, 'deleteAddress'])->name('addresses.destroy');
    });

    // Invoice
    Route::get('/invoice/{order}', [InvoiceController::class, 'download'])->name('invoice.download');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});
