<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::where('status', 'active')
            ->where('name', 'like', "%{$query}%")
            ->with('category')
            ->select('id', 'name', 'slug', 'price', 'images', 'category_id')
            ->take(6)
            ->get()
            ->map(function ($p) {
                return [
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'price' => '₹' . number_format($p->price, 0),
                    'category' => $p->category->name ?? '',
                    'image' => $p->primaryImageUrl(),
                    'url' => route('products.show', $p->slug),
                ];
            });

        return response()->json($products);
    }
}
