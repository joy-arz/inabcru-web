<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'title_id',
        'title_en',
        'bio_id',
        'bio_en',
        'photo_url',
        'linkedin_url',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }

    public function getBioAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->bio_id : $this->bio_en;
    }
}