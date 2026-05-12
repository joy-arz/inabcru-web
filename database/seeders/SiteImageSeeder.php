<?php

namespace Database\Seeders;

use App\Models\SiteImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SiteImageSeeder extends Seeder
{
    public function run(): void
    {
        $imageFolders = [
            'Field activity' => 'field_activity',
            'Board member' => 'board_member',
            'Logo' => 'logo',
        ];

        $basePath = public_path('images');

        foreach ($imageFolders as $folder => $category) {
            $folderPath = $basePath . '/' . $folder;
            if (!is_dir($folderPath)) continue;

            $files = glob($folderPath . '/*.{webp,jpg,jpeg,png,gif}', GLOB_BRACE);

            foreach ($files as $file) {
                $filename = basename($file);
                $key = strtolower(str_replace([' ', '.'], '_', preg_replace('/\.(webp|jpg|jpeg|png|gif)$/i', '', $filename)));
                $key = $category . '_' . $key;

                if (SiteImage::where('key', $key)->exists()) continue;

                SiteImage::create([
                    'key' => $key,
                    'category' => $category,
                    'image_url' => '/images/' . $folder . '/' . $filename,
                    'alt_text' => ucwords(str_replace(['_', '-'], ' ', $filename)),
                    'folder_path' => '/images/' . $folder . '/',
                ]);
            }
        }
    }
}