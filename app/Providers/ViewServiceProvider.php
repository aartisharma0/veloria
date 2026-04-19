<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $cartCount = 0;
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $cartCount += $item['qty'];
            }

            $wishlistCount = 0;
            if (auth()->check()) {
                $wishlistCount = auth()->user()->wishlists()->count();
                // Eager load wishlists for wishlist button checks
                auth()->user()->load('wishlists');
            }

            $view->with('cartCount', $cartCount);
            $view->with('wishlistCount', $wishlistCount);
        });
    }

    public function register(): void {}
}
