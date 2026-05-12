<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $fillable = [
        'key',
        'category',
        'image_url',
        'alt_text',
        'folder_path',
    ];
}