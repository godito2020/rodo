<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'technical_specs',
        'price',
        'sale_price',
        'show_price',
        'action_type',
        'stock',
        'is_featured',
        'is_active',
        'views_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'technical_specs' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'show_price' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views_count' => 'integer',
        'stock' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'RODO-' . strtoupper(Str::random(6));
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('is_primary', 'desc')->orderBy('order', 'asc');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function getEffectivePriceAttribute()
    {
        return ($this->sale_price && $this->sale_price > 0 && $this->sale_price < $this->price)
            ? $this->sale_price
            : $this->price;
    }

    public function getHasDiscountAttribute(): bool
    {
        return $this->sale_price && $this->sale_price > 0 && $this->sale_price < $this->price;
    }

    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->has_discount || $this->price <= 0) {
            return 0;
        }
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getMainImageUrlAttribute(): string
    {
        $primary = $this->images->where('is_primary', true)->first();
        if ($primary && $primary->image_path) {
            return asset($primary->image_path);
        }

        $first = $this->images->first();
        if ($first && $first->image_path) {
            return asset($first->image_path);
        }

        return asset('images/logo/RODO.png');
    }

    public function getWhatsappInquiryUrlAttribute(): string
    {
        $phone = Setting::get('whatsapp_number', '+51987654321');
        $phoneClean = preg_replace('/[^0-9]/', '', $phone);

        $currency = Setting::get('currency_symbol', 'S/.');
        $priceText = $this->show_price ? " Precio ref: {$currency} " . number_format($this->effective_price, 2) : "";
        $url = route('products.show', $this->slug);

        $message = "¡Hola RODOPERU! Estoy interesado en cotizar el siguiente producto:\n\n" .
                   "🚘 Modelo: {$this->name}\n" .
                   "🔢 Código SKU: {$this->sku}\n" .
                   ($priceText ? "💰{$priceText}\n" : "") .
                   "🔗 Enlace: {$url}\n\n" .
                   "¿Tienen disponibilidad y asesoría técnica para este modelo?";

        return 'https://api.whatsapp.com/send?phone=' . $phoneClean . '&text=' . rawurlencode($message);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
