<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    protected $fillable = [
        'division_id',
        'title_id',
        'title_en',
        'slug',
        'short_description_id',
        'short_description_en',
        'description_id',
        'description_en',
        'icon',
        'featured_image_url',
        'featured_image_alt',
        'carousel_images',
        'active',
        'display_order',
    ];

    protected $casts = [
        'carousel_images' => 'array',
        'active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }

    public function getShortDescriptionAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->short_description_id : $this->short_description_en;
    }

    public function getDescriptionAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->description_id : $this->description_en;
    }
}