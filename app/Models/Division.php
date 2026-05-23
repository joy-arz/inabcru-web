<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    protected $fillable = [
        'name_id',
        'name_en',
        'slug',
        'description_id',
        'description_en',
        'display_order',
        'active',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'active' => 'boolean',
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class)->where('active', true)->orderBy('display_order');
    }

    public function getNameAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->name_id : $this->name_en;
    }
}