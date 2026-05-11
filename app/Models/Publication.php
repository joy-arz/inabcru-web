<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title_id',
        'title_en',
        'abstract_id',
        'abstract_en',
        'journal',
        'year',
        'doi',
        'cover_image_url',
        'content_blocks',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'year' => 'integer',
    ];

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }
}