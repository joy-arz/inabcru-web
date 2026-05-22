<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $fillable = [
        'key',
        'category',
        'type',
        'location',
        'image_url',
        'alt_text',
        'usage',
        'folder_path',
    ];
}