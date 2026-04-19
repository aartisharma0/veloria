<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ReviewThanksMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 'active')->with('category');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->category)->with('children')->first();
            if ($cat) {
                $catIds = $cat->children->pluck('id')->push($cat->id)->toArray();
                $query->whereIn('category_id', $catIds);
            }
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_low' => $query->orderBy('price', 'asc'),
                'price_high' => $query->orderBy('price', 'desc'),
                'newest' => $query->latest(),
                'name' => $query->orderBy('name'),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->with('children')->orderBy('sort_order')->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 'active')->with(['category', 'variants'])->firstOrFail();
        $reviews = $product->reviews()->where('approved', true)->with('user')->latest()->paginate(5);
        // Related: same category, then sibling categories, then random
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->inRandomOrder()->take(4)->get();

        if ($relatedProducts->count() < 4) {
            $excludeIds = $relatedProducts->pluck('id')->push($product->id);
            $parentCat = $product->category?->parent;
            $needed = 4 - $relatedProducts->count();

            if ($parentCat) {
                $siblingCatIds = Category::where('parent_id', $parentCat->id)->pluck('id');
                $more = Product::whereIn('category_id', $siblingCatIds)
                    ->whereNotIn('id', $excludeIds)->where('status', 'active')
                    ->inRandomOrder()->take($needed)->get();
                $relatedProducts = $relatedProducts->merge($more);
            }

            $needed = 4 - $relatedProducts->count();
            if ($needed > 0) {
                $excludeIds = $relatedProducts->pluck('id')->push($product->id);
                $more = Product::whereNotIn('id', $excludeIds)->where('status', 'active')
                    ->inRandomOrder()->take($needed)->get();
                $relatedProducts = $relatedProducts->merge($more);
            }
        }

        // Track recently viewed
        $recentlyViewed = session()->get('recently_viewed', []);
        $recentlyViewed = array_filter($recentlyViewed, fn($id) => $id !== $product->id);
        array_unshift($recentlyViewed, $product->id);
        session()->put('recently_viewed', array_slice($recentlyViewed, 0, 8));

        // Get recently viewed products (excluding current)
        $recentIds = array_filter(session('recently_viewed', []), fn($id) => $id !== $product->id);
        $recentProducts = Product::whereIn('id', array_slice($recentIds, 0, 4))->where('status', 'active')->get();

        return view('frontend.products.show', compact('product', 'reviews', 'relatedProducts', 'recentProducts'));
    }

    public function review(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'body' => 'nullable|string|max:1000',
        ]);

        $existing = Review::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        if ($existing) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        // Check if user has purchased this product (verified purchase)
        $hasPurchased = auth()->user()->orders()
            ->where('status', '!=', 'cancelled')
            ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
            ->exists();

        if (!$hasPurchased && !auth()->user()->isAdmin()) {
            return back()->with('error', 'You can only review products you have purchased.');
        }

        $autoApprove = auth()->user()->isAdmin();

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'body' => strip_tags($request->body),
            'approved' => $autoApprove,
        ]);

        // Send thank you email
        $review = Review::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        try { Mail::to(auth()->user()->email)->send(new ReviewThanksMail($review)); } catch (\Exception $e) {}

        $message = $autoApprove
            ? 'Review published successfully!'
            : 'Thank you! Your review will appear after admin approval.';

        return back()->with('success', $message);
    }
}
