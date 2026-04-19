<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'stock',
        'images',
        'status',
        'featured',
        'sku',
        'weight',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function averageRating()
    {
        return $this->reviews()->where('approved', true)->avg('rating');
    }

    public function primaryImage()
    {
        $images = $this->images;
        return $images && count($images) > 0 ? $images[0] : null;
    }

    public function primaryImageUrl()
    {
        $img = $this->primaryImage();
        if ($img) {
            // If it starts with http, it's an external URL
            if (str_starts_with($img, 'http')) return $img;
            return asset('storage/' . $img);
        }
        // Generate a color-based placeholder with product initials
        $colors = ['E8B4B8', 'A8D8EA', 'D5C4A1', 'C3B1E1', 'B5EAD7', 'FFD6A5'];
        $color = $colors[crc32($this->name) % count($colors)];
        $initials = urlencode(strtoupper(substr($this->name, 0, 2)));
        return "https://via.placeholder.com/400x450/{$color}/333?text={$initials}";
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}
