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

        $order = 1;
        foreach ($categories as $parent => $children) {
            $parentCategory = Category::updateOrCreate(
                ['slug' => Str::slug($parent)],
                [
                    'name' => $parent,
                    'is_active' => true,
                    'sort_order' => $order++,
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
