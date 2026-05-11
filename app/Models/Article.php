<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title_id',
        'title_en',
        'content_id',
        'content_en',
        'category',
        'featured_image_url',
        'slug',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }

    public function getContentAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->content_id : $this->content_en;
    }
}