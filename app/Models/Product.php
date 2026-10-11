<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'features',
        'specifications',
        'image',
        'images',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'images' => 'array',
    ];

    protected $appends = [
        'all_images',
    ];

    public function getAllImagesAttribute(): array
    {
        $list = is_array($this->images) ? $this->images : [];
        if (!empty($this->image) && !in_array($this->image, $list)) {
            array_unshift($list, $this->image);
        }
        return array_values(array_filter($list));
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
