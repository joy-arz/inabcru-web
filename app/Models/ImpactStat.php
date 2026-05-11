<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStat extends Model
{
    protected $fillable = [
        'label_id',
        'label_en',
        'value',
        'icon',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function getLabelAttribute($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $locale === 'id' ? $this->label_id : $this->label_en;
    }
}