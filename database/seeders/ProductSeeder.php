<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Women's Dresses
            ['name' => 'Floral Maxi Dress', 'category' => 'women-dresses', 'price' => 2499, 'compare' => 3999, 'stock' => 25, 'featured' => true, 'img' => 'products/floral-maxi-dress.jpg', 'desc' => 'Elegant floral print maxi dress perfect for summer outings. Made with breathable cotton blend fabric.'],
            ['name' => 'Black Bodycon Dress', 'category' => 'women-dresses', 'price' => 1899, 'compare' => 2499, 'stock' => 18, 'featured' => true, 'img' => 'products/black-bodycon-dress.jpg', 'desc' => 'Sophisticated black bodycon dress for evening events. Sleek silhouette with a flattering fit.'],
            ['name' => 'Embroidered Anarkali Suit', 'category' => 'women-ethnic-wear', 'price' => 3499, 'compare' => 5999, 'stock' => 12, 'featured' => true, 'img' => 'products/embroidered-anarkali.jpg', 'desc' => 'Beautiful embroidered Anarkali suit with dupatta. Traditional craftsmanship meets modern elegance.'],
            ['name' => 'Silk Saree - Royal Blue', 'category' => 'women-ethnic-wear', 'price' => 4999, 'compare' => 7999, 'stock' => 8, 'featured' => true, 'img' => 'products/silk-saree.jpg', 'desc' => 'Pure silk saree in royal blue with gold zari border. Perfect for weddings and festive occasions.'],
            ['name' => 'Casual Striped Top', 'category' => 'women-tops', 'price' => 799, 'compare' => 1299, 'stock' => 40, 'featured' => false, 'img' => 'products/casual-striped-top.jpg', 'desc' => 'Comfortable striped casual top. Perfect for everyday wear with jeans or skirts.'],
            ['name' => 'Ruffled Blouse', 'category' => 'women-tops', 'price' => 1199, 'compare' => 1799, 'stock' => 30, 'featured' => false, 'img' => 'products/ruffled-blouse.jpg', 'desc' => 'Trendy ruffled blouse with elegant neckline. Great for office and casual outings.'],
            ['name' => 'High Waist Skinny Jeans', 'category' => 'women-jeans', 'price' => 1599, 'compare' => 2199, 'stock' => 35, 'featured' => false, 'img' => 'products/high-waist-jeans.jpg', 'desc' => 'Classic high waist skinny jeans with stretchable denim. Comfortable fit all day long.'],

            // Men's Clothing
            ['name' => 'Slim Fit Oxford Shirt', 'category' => 'men-shirts', 'price' => 1299, 'compare' => 1999, 'stock' => 30, 'featured' => true, 'img' => 'products/oxford-shirt.jpg', 'desc' => 'Premium cotton Oxford shirt with a slim fit cut. Perfect for office and smart casual looks.'],
            ['name' => 'Linen Casual Shirt', 'category' => 'men-shirts', 'price' => 1499, 'compare' => 2299, 'stock' => 22, 'featured' => false, 'img' => 'products/linen-shirt.jpg', 'desc' => 'Breathable linen shirt for summer. Light and comfortable with a relaxed fit.'],
            ['name' => 'Graphic Print T-Shirt', 'category' => 'men-t-shirts', 'price' => 699, 'compare' => 999, 'stock' => 50, 'featured' => false, 'img' => 'products/graphic-tshirt.jpg', 'desc' => 'Cool graphic print t-shirt made from 100% organic cotton. Statement piece for casual days.'],
            ['name' => 'Polo T-Shirt - Navy', 'category' => 'men-t-shirts', 'price' => 899, 'compare' => 1399, 'stock' => 45, 'featured' => true, 'img' => 'products/polo-tshirt.jpg', 'desc' => 'Classic polo t-shirt in navy blue. Premium pique cotton with embroidered logo.'],
            ['name' => 'Slim Fit Chinos', 'category' => 'men-casual-wear', 'price' => 1399, 'compare' => 1999, 'stock' => 28, 'featured' => false, 'img' => 'products/slim-chinos.jpg', 'desc' => 'Versatile slim fit chinos. Perfect for both office and weekend wear.'],
            ['name' => 'Blazer - Charcoal Grey', 'category' => 'men-formal-wear', 'price' => 4999, 'compare' => 7999, 'stock' => 10, 'featured' => true, 'img' => 'products/blazer-grey.jpg', 'desc' => 'Tailored charcoal grey blazer. Premium wool blend fabric with satin lining.'],
            ['name' => 'Tapered Jeans - Indigo', 'category' => 'men-jeans', 'price' => 1799, 'compare' => 2499, 'stock' => 32, 'featured' => false, 'img' => 'products/tapered-jeans.jpg', 'desc' => 'Modern tapered fit jeans in classic indigo wash. Durable denim with slight stretch.'],

            // Kids
            ['name' => 'Kids Dinosaur T-Shirt', 'category' => 'kids-boys', 'price' => 499, 'compare' => 799, 'stock' => 60, 'featured' => false, 'img' => 'products/kids-dino-tshirt.jpg', 'desc' => 'Fun dinosaur print t-shirt for boys. Soft cotton fabric, perfect for playtime.'],
            ['name' => 'Girls Tutu Dress - Pink', 'category' => 'kids-girls', 'price' => 899, 'compare' => 1499, 'stock' => 20, 'featured' => true, 'img' => 'products/girls-tutu-dress.jpg', 'desc' => 'Adorable pink tutu dress for little girls. Perfect for parties and special occasions.'],

            // Footwear
            ['name' => 'White Leather Sneakers', 'category' => 'sneakers', 'price' => 2999, 'compare' => 4499, 'stock' => 15, 'featured' => true, 'img' => 'products/white-sneakers.jpg', 'desc' => 'Classic white leather sneakers. Clean design with cushioned sole for all-day comfort.'],
            ['name' => 'Block Heel Sandals', 'category' => 'heels', 'price' => 1999, 'compare' => 2999, 'stock' => 18, 'featured' => false, 'img' => 'products/block-heel-sandals.jpg', 'desc' => 'Elegant block heel sandals in nude. Comfortable heel height for day-to-night wear.'],
            ['name' => 'Running Shoes - Black', 'category' => 'sneakers', 'price' => 3499, 'compare' => 5499, 'stock' => 20, 'featured' => false, 'img' => 'products/running-shoes.jpg', 'desc' => 'Lightweight running shoes with mesh upper. Responsive cushioning for maximum performance.'],
            ['name' => 'Chelsea Boots - Brown', 'category' => 'boots', 'price' => 3999, 'compare' => 5999, 'stock' => 12, 'featured' => true, 'img' => 'products/chelsea-boots.jpg', 'desc' => 'Classic brown Chelsea boots in genuine leather. Timeless style with elastic side panels.'],

            // Accessories
            ['name' => 'Leather Tote Bag', 'category' => 'bags', 'price' => 2499, 'compare' => 3999, 'stock' => 15, 'featured' => true, 'img' => 'products/leather-tote.jpg', 'desc' => 'Spacious leather tote bag with multiple compartments. Perfect for work and travel.'],
            ['name' => 'Analog Watch - Rose Gold', 'category' => 'watches', 'price' => 3999, 'compare' => 6999, 'stock' => 10, 'featured' => true, 'img' => 'products/rose-gold-watch.jpg', 'desc' => 'Elegant rose gold analog watch with mesh strap. Water resistant with Japanese movement.'],
            ['name' => 'Aviator Sunglasses', 'category' => 'sunglasses', 'price' => 1299, 'compare' => 1999, 'stock' => 25, 'featured' => false, 'img' => 'products/aviator-sunglasses.jpg', 'desc' => 'Classic aviator sunglasses with UV400 protection. Lightweight metal frame.'],
            ['name' => 'Pearl Necklace Set', 'category' => 'jewellery', 'price' => 1799, 'compare' => 2999, 'stock' => 14, 'featured' => false, 'img' => 'products/pearl-necklace.jpg', 'desc' => 'Elegant faux pearl necklace and earring set. Perfect for formal occasions.'],
            ['name' => 'Leather Belt - Black', 'category' => 'belts', 'price' => 899, 'compare' => 1299, 'stock' => 30, 'featured' => false, 'img' => 'products/leather-belt.jpg', 'desc' => 'Genuine leather belt with brushed silver buckle. Fits waist sizes 28-42.'],

            // Beauty
            ['name' => 'Hydrating Face Serum', 'category' => 'skincare', 'price' => 999, 'compare' => 1499, 'stock' => 40, 'featured' => false, 'img' => 'products/face-serum.jpg', 'desc' => 'Hyaluronic acid face serum for deep hydration. Suitable for all skin types.'],
            ['name' => 'Matte Lipstick Set', 'category' => 'makeup', 'price' => 1299, 'compare' => 1999, 'stock' => 35, 'featured' => true, 'img' => 'products/matte-lipstick.jpg', 'desc' => 'Set of 6 matte lipsticks in trending shades. Long-lasting formula with moisturizing base.'],
            ['name' => 'Eau de Parfum - Velvet Rose', 'category' => 'fragrances', 'price' => 2499, 'compare' => 3999, 'stock' => 20, 'featured' => false, 'img' => 'products/velvet-rose-perfume.jpg', 'desc' => 'Luxurious fragrance with notes of rose, jasmine, and sandalwood. Long-lasting 8+ hours.'],
        ];

        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colors = ['Black', 'White', 'Navy', 'Grey', 'Pink', 'Red', 'Blue', 'Green', 'Beige'];
        $shoeSizes = ['6', '7', '8', '9', '10', '11'];

        foreach ($products as $p) {
            $category = Category::where('slug', $p['category'])->first();
            if (!$category) continue;

            $product = Product::updateOrCreate(
                ['sku' => 'VLR-' . strtoupper(Str::random(6))],
                [
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name']) . '-' . Str::random(4),
                    'category_id' => $category->id,
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'compare_price' => $p['compare'],
                    'stock' => $p['stock'],
                    'status' => 'active',
                    'featured' => $p['featured'],
                    'images' => $this->generateImageUrls($p['name']),
                ]
            );

            // Add variants for clothing items
            $isClothing = str_contains($p['category'], 'women-') || str_contains($p['category'], 'men-') || str_contains($p['category'], 'kids-');
            $isFootwear = str_contains($p['category'], 'sneakers') || str_contains($p['category'], 'heels') || str_contains($p['category'], 'boots') || str_contains($p['category'], 'flats') || str_contains($p['category'], 'sandals');

            if ($isClothing) {
                $selectedSizes = array_slice($sizes, 1, 4); // S, M, L, XL
                $selectedColors = array_slice($colors, 0, 3);
                foreach ($selectedSizes as $size) {
                    ProductVariant::updateOrCreate(
                        ['product_id' => $product->id, 'sku' => $product->sku . '-' . $size],
                        ['size' => $size, 'color' => $selectedColors[array_rand($selectedColors)], 'price_modifier' => 0, 'stock' => rand(3, 15)]
                    );
                }
            } elseif ($isFootwear) {
                foreach (array_slice($shoeSizes, 0, 4) as $size) {
                    ProductVariant::updateOrCreate(
                        ['product_id' => $product->id, 'sku' => $product->sku . '-' . $size],
                        ['size' => 'UK ' . $size, 'color' => null, 'price_modifier' => 0, 'stock' => rand(2, 10)]
                    );
                }
            }
        }

        // Create test coupons
        Coupon::updateOrCreate(['code' => 'VELORIA10'], [
            'type' => 'percent', 'value' => 10, 'min_order' => 999,
            'uses_left' => 100, 'expires_at' => now()->addMonths(3), 'is_active' => true,
        ]);
        Coupon::updateOrCreate(['code' => 'FLAT200'], [
            'type' => 'flat', 'value' => 200, 'min_order' => 1499,
            'uses_left' => 50, 'expires_at' => now()->addMonths(2), 'is_active' => true,
        ]);
        Coupon::updateOrCreate(['code' => 'WELCOME20'], [
            'type' => 'percent', 'value' => 20, 'min_order' => 500,
            'uses_left' => 200, 'expires_at' => now()->addMonths(6), 'is_active' => true,
        ]);
    }

    private function generateImageUrls(string $name): array
    {
        $bgColors = [
            'Floral Maxi Dress' => 'FFB6C1', 'Black Bodycon Dress' => '2C2C2C',
            'Embroidered Anarkali Suit' => 'DAA520', 'Silk Saree - Royal Blue' => '4169E1',
            'Casual Striped Top' => 'F0E68C', 'Ruffled Blouse' => 'DDA0DD',
            'High Waist Skinny Jeans' => '4682B4', 'Slim Fit Oxford Shirt' => 'F5F5DC',
            'Linen Casual Shirt' => 'D2B48C', 'Graphic Print T-Shirt' => '20B2AA',
            'Polo T-Shirt - Navy' => '000080', 'Slim Fit Chinos' => 'C4A882',
            'Blazer - Charcoal Grey' => '36454F', 'Tapered Jeans - Indigo' => '3F51B5',
            'Kids Dinosaur T-Shirt' => '66BB6A', 'Girls Tutu Dress - Pink' => 'FF69B4',
            'White Leather Sneakers' => 'F5F5F5', 'Block Heel Sandals' => 'D4A574',
            'Running Shoes - Black' => '333333', 'Chelsea Boots - Brown' => '8B4513',
            'Leather Tote Bag' => 'A0522D', 'Analog Watch - Rose Gold' => 'B76E79',
            'Aviator Sunglasses' => '708090', 'Pearl Necklace Set' => 'FDEEF4',
            'Leather Belt - Black' => '1C1C1C', 'Hydrating Face Serum' => 'E0F7FA',
            'Matte Lipstick Set' => 'C62828', 'Eau de Parfum - Velvet Rose' => '9C27B0',
        ];

        $textColors = [
            '2C2C2C' => 'fff', '000080' => 'fff', '36454F' => 'fff', '333333' => 'fff',
            '3F51B5' => 'fff', '1C1C1C' => 'fff', '8B4513' => 'fff', 'A0522D' => 'fff',
            'C62828' => 'fff', '9C27B0' => 'fff', '4169E1' => 'fff', '4682B4' => 'fff',
        ];

        $bg = $bgColors[$name] ?? 'E8B4B8';
        $fg = $textColors[$bg] ?? '333';
        $text = urlencode($name);

        return [
            "https://placehold.co/600x700/{$bg}/{$fg}?text={$text}&font=playfair-display",
        ];
    }
}
