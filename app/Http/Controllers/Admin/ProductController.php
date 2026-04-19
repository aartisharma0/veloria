<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->withCount('variants', 'reviews');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::whereNull('parent_id')->with('children')->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'weight' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,draft',
            'featured' => 'boolean',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'variant_sizes' => 'nullable|array',
            'variant_colors' => 'nullable|array',
            'variant_prices' => 'nullable|array',
            'variant_stocks' => 'nullable|array',
            'variant_skus' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(5);
        $validated['featured'] = $request->has('featured');

        // Handle images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }
        $validated['images'] = $imagePaths;

        DB::transaction(function () use ($validated, $request) {
            $product = Product::create($validated);

            // Handle variants
            if ($request->filled('variant_skus')) {
                foreach ($request->variant_skus as $i => $sku) {
                    if (empty($sku)) continue;
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => $sku,
                        'size' => $request->variant_sizes[$i] ?? null,
                        'color' => $request->variant_colors[$i] ?? null,
                        'price_modifier' => $request->variant_prices[$i] ?? 0,
                        'stock' => $request->variant_stocks[$i] ?? 0,
                    ]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('variants');
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'weight' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,draft',
            'featured' => 'boolean',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'remove_images' => 'nullable|array',
        ]);

        $validated['featured'] = $request->has('featured');

        // Handle image removal
        $currentImages = $product->images ?? [];
        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $img) {
                Storage::disk('public')->delete($img);
                $currentImages = array_filter($currentImages, fn($i) => $i !== $img);
            }
        }

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $currentImages[] = $image->store('products', 'public');
            }
        }
        $validated['images'] = array_values($currentImages);

        DB::transaction(function () use ($validated, $request, $product) {
            $product->update($validated);

            // Update variants
            $product->variants()->delete();
            if ($request->filled('variant_skus')) {
                foreach ($request->variant_skus as $i => $sku) {
                    if (empty($sku)) continue;
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'sku' => $sku,
                        'size' => $request->variant_sizes[$i] ?? null,
                        'color' => $request->variant_colors[$i] ?? null,
                        'price_modifier' => $request->variant_prices[$i] ?? 0,
                        'stock' => $request->variant_stocks[$i] ?? 0,
                    ]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->images) {
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
