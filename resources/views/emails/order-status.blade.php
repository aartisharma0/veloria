<x-mail::message>
# Order Update

Hi {{ $order->user->name }},

Your order **{{ $order->order_number }}** status has been updated.

**Previous Status:** {{ ucfirst($oldStatus) }}
**New Status:** {{ ucfirst($order->status) }}

@if($order->status === 'shipped' && $order->tracking_number)
**Tracking Number:** {{ $order->tracking_number }}
@endif

@if($order->status === 'delivered')
We hope you love your purchase! Please consider leaving a review.
@endif

<x-mail::button :url="url('/account/orders/' . $order->id)">
View Order Details
</x-mail::button>

Thanks,<br>
Team Veloria
</x-mail::message>
