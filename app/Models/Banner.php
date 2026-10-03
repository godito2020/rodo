<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'type', // middle, hero_side, popup, footer
        'image_path',
        'button_text',
        'button_url',
        'countdown_date',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'countdown_date' => 'datetime',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ? asset($this->image_path) : '';
    }
}
