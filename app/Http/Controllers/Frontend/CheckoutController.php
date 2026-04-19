<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $this->getCartDetails($cart);
        $subtotal = collect($cartItems)->sum('total');
        $discount = session('cart_discount', 0);
        $tax = round(($subtotal - $discount) * 0.18, 2);
        $shipping = $subtotal >= 999 ? 0 : 99;
        $total = $subtotal - $discount + $tax + $shipping;

        $addresses = auth()->user()->addresses;
        $defaultAddress = $addresses->where('is_default', true)->where('type', 'shipping')->first() ?? $addresses->first();
        $stripeKey = config('services.stripe.key');

        return view('frontend.checkout.index', compact('cartItems', 'subtotal', 'discount', 'tax', 'shipping', 'total', 'addresses', 'defaultAddress', 'stripeKey'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:stripe,cod',
            'stripeToken' => 'required_if:payment_method,stripe',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $address = Address::where('id', $request->shipping_address_id)->where('user_id', auth()->id())->firstOrFail();
        $cartItems = $this->getCartDetails($cart);
        $subtotal = collect($cartItems)->sum('total');
        $discount = session('cart_discount', 0);
        $tax = round(($subtotal - $discount) * 0.18, 2);
        $shipping = $subtotal >= 999 ? 0 : 99;
        $total = $subtotal - $discount + $tax + $shipping;

        // For Stripe: charge FIRST, only create order if payment succeeds
        $stripeCharge = null;
        if ($request->payment_method === 'stripe') {
            try {
                $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
                $stripeCharge = $stripe->charges->create([
                    'amount' => (int)($total * 100),
                    'currency' => 'inr',
                    'source' => $request->stripeToken,
                    'description' => 'Veloria Order by ' . auth()->user()->email,
                    'metadata' => ['user_id' => auth()->id()],
                ]);
            } catch (\Stripe\Exception\CardException $e) {
                return back()->with('error', 'Card declined: ' . $e->getMessage());
            } catch (\Exception $e) {
                return back()->with('error', 'Payment failed: ' . $e->getMessage());
            }
        }

        // Payment succeeded (or COD chosen) — now create the order
        $order = DB::transaction(function () use ($request, $cartItems, $subtotal, $discount, $tax, $shipping, $total, $address, $stripeCharge) {
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'status' => $stripeCharge ? 'processing' : 'pending',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'shipping_cost' => $shipping,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'shipping_address_id' => $address->id,
                'billing_address_id' => $address->id,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['price'],
                    'total' => $item['total'],
                ]);

                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->decrement('stock', $item['qty']);
                }
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'provider' => $request->payment_method,
                'amount' => $total,
                'transaction_id' => $stripeCharge?->id,
                'status' => $stripeCharge ? 'completed' : 'pending',
                'paid_at' => $stripeCharge ? now() : null,
            ]);

            // Decrement coupon uses
            $couponCode = session('cart_coupon');
            if ($couponCode) {
                $coupon = Coupon::where('code', $couponCode)->first();
                if ($coupon && $coupon->uses_left !== null) {
                    $coupon->decrement('uses_left');
                }
            }

            return $order;
        });

        // Clear cart
        session()->forget(['cart', 'cart_discount', 'cart_coupon']);

        // Send order confirmation email
        try {
            $order->load(['items.product', 'user', 'shippingAddress', 'payment']);
            Mail::to(auth()->user()->email)->send(new OrderConfirmationMail($order));
        } catch (\Exception $e) {}

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        $order->load(['items.product', 'shippingAddress', 'payment']);
        return view('frontend.checkout.success', compact('order'));
    }

    private function getCartDetails(array $cart): array
    {
        $items = [];
        foreach ($cart as $key => $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;
            $items[$key] = array_merge($item, [
                'product' => $product,
                'total' => $item['price'] * $item['qty'],
            ]);
        }
        return $items;
    }
}
