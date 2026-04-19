<x-mail::message>
# Welcome to Veloria, {{ $user->name }}!

Thank you for creating your account. You're now part of the Veloria family.

**"Where every piece tells your story"**

Start exploring our curated collections of fashion and lifestyle essentials.

<x-mail::button :url="url('/shop')">
Start Shopping
</x-mail::button>

**Your account details:**
- **Email:** {{ $user->email }}
- **Member since:** {{ $user->created_at->format('M d, Y') }}

Use code **WELCOME20** for 20% off your first order (min. order Rs.500).

Thanks,<br>
Team Veloria
</x-mail::message>
