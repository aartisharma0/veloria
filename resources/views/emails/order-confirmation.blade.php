<x-mail::message>
# Order Confirmed! 🎉

Hi {{ $order->user->name }},

Your order **{{ $order->order_number }}** has been placed successfully.

<x-mail::table>
| Product | Qty | Amount |
|:--------|:---:|-------:|
@foreach($order->items as $item)
| {{ $item->product->name ?? 'Product' }} | {{ $item->qty }} | ₹{{ number_format($item->total, 0) }} |
@endforeach
| | **Total** | **₹{{ number_format($order->total, 0) }}** |
</x-mail::table>

**Payment:** {{ strtoupper($order->payment_method) }}
@if($order->payment && $order->payment->status === 'completed')
**Status:** Paid ✅
@else
**Status:** Pending
@endif

@if($order->shippingAddress)
**Delivering to:** {{ $order->shippingAddress->full_name }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}
@endif

<x-mail::button :url="url('/account/orders/' . $order->id)">
Track Your Order
</x-mail::button>

Thanks for shopping with Veloria!<br>
Team Veloria
</x-mail::message>
