<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    private function getSettings(): array
    {
        $path = storage_path('app/settings.json');
        if (File::exists($path)) {
            return json_decode(File::get($path), true) ?? [];
        }
        return $this->defaults();
    }

    private function saveSettings(array $settings): void
    {
        File::put(storage_path('app/settings.json'), json_encode($settings, JSON_PRETTY_PRINT));
    }

    private function defaults(): array
    {
        return [
            'store_name' => 'Veloria',
            'tagline' => 'Where every piece tells your story',
            'store_email' => 'support@veloria.com',
            'store_phone' => '+91 98765 43210',
            'store_address' => '123 Fashion Street, Mumbai, India 400001',
            'currency' => 'INR',
            'currency_symbol' => '₹',
            'tax_rate' => '18',
            'free_shipping_min' => '999',
            'shipping_fee' => '99',
            'cod_max_amount' => '10000',
            'facebook_url' => '',
            'instagram_url' => '',
            'twitter_url' => '',
            'youtube_url' => '',
            'pinterest_url' => '',
            'meta_title' => 'Veloria - Fashion & Lifestyle E-Commerce',
            'meta_description' => 'Discover the latest fashion trends at Veloria. Shop curated collections of clothing, footwear, accessories, and beauty products.',
            'maintenance_mode' => false,
        ];
    }

    public function index()
    {
        $settings = array_merge($this->defaults(), $this->getSettings());
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'nullable|string|max:30',
            'store_address' => 'nullable|string|max:500',
            'currency' => 'required|string|max:10',
            'currency_symbol' => 'required|string|max:5',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'free_shipping_min' => 'required|numeric|min:0',
            'shipping_fee' => 'required|numeric|min:0',
            'cod_max_amount' => 'required|numeric|min:0',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'pinterest_url' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $validated['maintenance_mode'] = $request->has('maintenance_mode');

        $this->saveSettings($validated);

        return back()->with('success', 'Settings updated successfully.');
    }
}
