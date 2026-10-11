<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'images',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'images' => 'array',
    ];

    protected $appends = [
        'all_images',
        'published_at_input',
        'published_at_formatted',
    ];

    public function getAllImagesAttribute(): array
    {
        $list = is_array($this->images) ? $this->images : [];
        if (!empty($this->image) && !in_array($this->image, $list)) {
            array_unshift($list, $this->image);
        }
        return array_values(array_filter($list));
    }

    public function getPublishedAtInputAttribute(): string
    {
        $dt = $this->published_at ?: $this->created_at ?: now();
        return $dt->format('Y-m-d\TH:i');
    }

    public function getPublishedAtFormattedAttribute(): string
    {
        $dt = $this->published_at ?: $this->created_at ?: now();
        return $dt->format('Y.m.d');
    }

    public function getIsPublishedAttribute(): bool
    {
        return !is_null($this->published_at) && $this->published_at->lte(now()->addMinutes(5));
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now()->addMinutes(5));
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
