<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = $this->getCartDetails($cart);
        $subtotal = collect($cartItems)->sum('total');
        $discount = session('cart_discount', 0);
        $couponCode = session('cart_coupon', null);
        $tax = round(($subtotal - $discount) * 0.18, 2); // 18% GST
        $total = $subtotal - $discount + $tax;

        return view('frontend.cart.index', compact('cartItems', 'subtotal', 'discount', 'couponCode', 'tax', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'qty' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variant = $request->variant_id ? ProductVariant::find($request->variant_id) : null;

        // Check if product is active
        if ($product->status !== 'active') {
            return back()->with('error', 'This product is currently unavailable.');
        }

        // Check stock
        $availableStock = $variant ? $variant->stock : $product->stock;
        if ($availableStock <= 0) {
            return back()->with('error', "{$product->name} is out of stock.");
        }

        $cartKey = $product->id . '-' . ($variant ? $variant->id : '0');
        $price = $variant ? $product->price + $variant->price_modifier : $product->price;

        $cart = session()->get('cart', []);
        $currentQtyInCart = isset($cart[$cartKey]) ? $cart[$cartKey]['qty'] : 0;
        $requestedQty = $currentQtyInCart + $request->qty;

        // Check if requested quantity exceeds stock
        if ($requestedQty > $availableStock) {
            $canAdd = $availableStock - $currentQtyInCart;
            if ($canAdd <= 0) {
                return back()->with('error', "You already have all available stock of {$product->name} in your bag ({$availableStock} items).");
            }
            return back()->with('error', "Only {$availableStock} units of {$product->name} available. You already have {$currentQtyInCart} in your bag.");
        }

        // Max 10 per item
        if ($requestedQty > 10) {
            return back()->with('error', 'Maximum 10 units per product allowed.');
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['qty'] = $requestedQty;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'variant_id' => $variant?->id,
                'name' => $product->name,
                'price' => $price,
                'image' => $product->primaryImage(),
                'qty' => $request->qty,
                'size' => $variant?->size,
                'color' => $variant?->color,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', "{$product->name} added to your bag!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'qty' => 'required|integer|min:1|max:10',
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->key])) {
            $item = $cart[$request->key];
            $product = Product::find($item['product_id']);

            if ($product) {
                $variant = $item['variant_id'] ? ProductVariant::find($item['variant_id']) : null;
                $availableStock = $variant ? $variant->stock : $product->stock;

                if ($request->qty > $availableStock) {
                    return back()->with('error', "Only {$availableStock} units of {$product->name} available.");
                }
            }

            $cart[$request->key]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        $this->revalidateCoupon($cart);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->key]);
        session()->put('cart', $cart);

        if (empty($cart)) {
            session()->forget(['cart_discount', 'cart_coupon']);
        } else {
            $this->revalidateCoupon($cart);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string']);

        $coupon = Coupon::where('code', strtoupper($request->coupon_code))->first();

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('error', 'Invalid or expired coupon code.');
        }

        $cart = session()->get('cart', []);
        $subtotal = collect($this->getCartDetails($cart))->sum('total');

        $discount = $coupon->calculateDiscount($subtotal);

        if ($discount <= 0) {
            return back()->with('error', "Minimum order of ₹{$coupon->min_order} required for this coupon.");
        }

        session()->put('cart_discount', $discount);
        session()->put('cart_coupon', $coupon->code);

        return back()->with('success', "Coupon applied! You save ₹" . number_format($discount, 0));
    }

    public function removeCoupon()
    {
        session()->forget(['cart_discount', 'cart_coupon']);
        return back()->with('success', 'Coupon removed.');
    }

    private function getCartDetails(array $cart): array
    {
        $items = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;

            $items[$key] = array_merge($item, [
                'product' => $product,
                'image' => $product->primaryImage(),
                'total' => $item['price'] * $item['qty'],
            ]);
        }
        return $items;
    }

    private function revalidateCoupon(array $cart): void
    {
        $couponCode = session('cart_coupon');
        if (!$couponCode) return;

        $coupon = Coupon::where('code', $couponCode)->first();

        // Remove if coupon no longer exists or is expired
        if (!$coupon || !$coupon->isValid()) {
            session()->forget(['cart_discount', 'cart_coupon']);
            session()->flash('error', 'Coupon "' . $couponCode . '" has been removed (expired or invalid).');
            return;
        }

        // Recalculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        // Check min order
        if ($coupon->min_order && $subtotal < $coupon->min_order) {
            session()->forget(['cart_discount', 'cart_coupon']);
            session()->flash('error', 'Coupon "' . $couponCode . '" removed — minimum order is ₹' . number_format($coupon->min_order, 0) . '.');
            return;
        }

        // Recalculate discount with new subtotal
        $newDiscount = $coupon->calculateDiscount($subtotal);
        session()->put('cart_discount', $newDiscount);
    }
}
