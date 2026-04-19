<x-mail::message>
# Thanks for Your Review! ⭐

Hi {{ $review->user->name }},

Thank you for reviewing **{{ $review->product->name }}**.

**Your Rating:** {{ str_repeat('⭐', $review->rating) }}
@if($review->body)
**Your Review:** "{{ $review->body }}"
@endif

Your feedback helps other shoppers make better decisions. We truly appreciate it!

<x-mail::button :url="url('/shop')">
Continue Shopping
</x-mail::button>

Thanks,<br>
Team Veloria
</x-mail::message>
