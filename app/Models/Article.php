<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image_path',
        'category',
        'is_published',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ? asset($this->image_path) : asset('images/logo/RODO.png');
    }
}
