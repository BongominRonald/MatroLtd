<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HeroSlide extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'title_highlight',
        'description',
        'primary_cta_text',
        'primary_cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
        'image',
        'image_webp',
        'stats',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'stats' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function resolvedImageUrl(): string
    {
        $path = $this->image ?: 'img/banner-shipping.jpg';

        return Str::startsWith($path, ['http://', 'https://', '//'])
            ? $path
            : asset($path);
    }

    public function resolvedWebpUrl(): ?string
    {
        if (empty($this->image_webp)) {
            return null;
        }

        return Str::startsWith($this->image_webp, ['http://', 'https://', '//'])
            ? $this->image_webp
            : asset($this->image_webp);
    }
}
