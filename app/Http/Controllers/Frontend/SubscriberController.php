<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionThanksMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:255',
        ]);

        $exists = Subscriber::where('email', $request->email)->exists();

        if ($exists) {
            return back()->with('success', 'You are already subscribed! Thank you.');
        }

        Subscriber::create(['email' => $request->email]);

        try { Mail::to($request->email)->send(new SubscriptionThanksMail($request->email)); } catch (\Exception $e) {}

        return back()->with('success', 'Thank you for subscribing! Check your email for a welcome gift.');
    }
}
