<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Women' => ['Dresses', 'Tops', 'Jeans', 'Ethnic Wear', 'Western Wear'],
            'Men' => ['Shirts', 'T-Shirts', 'Jeans', 'Formal Wear', 'Casual Wear'],
            'Kids' => ['Boys', 'Girls', 'Infants'],
            'Footwear' => ['Sneakers', 'Heels', 'Flats', 'Boots', 'Sandals'],
            'Accessories' => ['Bags', 'Watches', 'Jewellery', 'Sunglasses', 'Belts'],
            'Beauty' => ['Skincare', 'Makeup', 'Fragrances', 'Hair Care'],
        ];

        $categoryImages = [
            'Women' => 'https://placehold.co/400x400/FFB6C1/fff?text=Women&font=playfair-display',
            'Men' => 'https://placehold.co/400x400/4682B4/fff?text=Men&font=playfair-display',
            'Kids' => 'https://placehold.co/400x400/66BB6A/fff?text=Kids&font=playfair-display',
            'Footwear' => 'https://placehold.co/400x400/8B4513/fff?text=Footwear&font=playfair-display',
            'Accessories' => 'https://placehold.co/400x400/DAA520/fff?text=Accessories&font=playfair-display',
            'Beauty' => 'https://placehold.co/400x400/DDA0DD/333?text=Beauty&font=playfair-display',
        ];

        $order = 1;
        foreach ($categories as $parent => $children) {
            $parentCategory = Category::updateOrCreate(
                ['slug' => Str::slug($parent)],
                [
                    'name' => $parent,
                    'is_active' => true,
                    'sort_order' => $order++,
                    'image' => $categoryImages[$parent] ?? null,
                ]
            );

            $childOrder = 1;
            foreach ($children as $child) {
                Category::updateOrCreate(
                    ['slug' => Str::slug($parent . '-' . $child)],
                    [
                        'name' => $child,
                        'parent_id' => $parentCategory->id,
                        'is_active' => true,
                        'sort_order' => $childOrder++,
                    ]
                );
            }
        }
    }
}
