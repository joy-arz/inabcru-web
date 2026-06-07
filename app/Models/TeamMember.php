<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'title_id',
        'title_en',
        'bio_id',
        'bio_en',
        'photo_url',
        'photo_position',
        'linkedin_url',
        'division_id',
        'role',
        'display_order',
    ];

    protected $casts = [
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

    public function getBioAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->bio_id : $this->bio_en;
    }
}