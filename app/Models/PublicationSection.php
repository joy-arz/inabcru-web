<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicationSection extends Model
{
    protected $fillable = [
        'title_id',
        'title_en',
        'display_order',
    ];

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public function getTitleAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->title_id : $this->title_en;
    }
}
