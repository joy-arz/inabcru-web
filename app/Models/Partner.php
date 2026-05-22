<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'logo_url',
        'alt_text',
        'website_url',
        'description',
        'display_order',
        'active',
    ];

    protected $casts = [
        'display_order' => 'integer',
        'active' => 'boolean',
    ];
}