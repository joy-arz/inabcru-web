<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        if (!$file) {
            return response()->json(['error' => 'No file provided'], 400);
        }

        $type = $request->input('type', 'image');
        $folder = "uploads/{$type}s";

        $allowedMimes = [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'],
            'video' => ['mp4', 'webm', 'mov', 'avi', 'mkv'],
            'pdf' => ['pdf'],
        ];

        $allowed = $allowedMimes[$type] ?? ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed)) {
            return response()->json(['error' => 'Invalid file type'], 400);
        }

        $uuid = Str::uuid();
        $extension = $file->getClientOriginalExtension();

        try {
            if ($type === 'image') {
                $result = $this->processImage($file, $folder, $uuid);
            } elseif ($type === 'video') {
                $result = $this->processVideo($file, $folder, $uuid, $extension);
            } elseif ($type === 'pdf') {
                $result = $this->processPdf($file, $folder, $uuid);
            } else {
                $filename = $uuid . '.' . $extension;
                $path = $file->storeAs($folder, $filename, 'public');
                $result = ['path' => $path, 'url' => asset('storage/' . $path)];
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Upload failed: ' . $e->getMessage()], 500);
        }

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        return response()->json($result);
    }

    private function processImage(UploadedFile $file, string $folder, string $uuid): array
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $tempPath = $file->getRealPath();

        $this->ensureDirectoryExists($folder);

        if (extension_loaded('imagick')) {
            try {
                $webpPath = storage_path("app/public/{$folder}/{$uuid}.webp");
                $image = new \Imagick($tempPath);

                if ($image->getImageWidth() > 1920) {
                    $image->resizeImage(1920, 0, \Imagick::FILTER_LANCZOS, 1);
                }

                $image->setImageFormat('webp');
                $image->setImageQuality(85);
                $image->writeImage($webpPath);
                $image->destroy();

                if (file_exists($webpPath)) {
                    return [
                        'path' => "{$folder}/{$uuid}.webp",
                        'url' => asset('storage/' . "{$folder}/{$uuid}.webp")
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Imagick image processing failed: ' . $e->getMessage());
            }
        }

        if (extension_loaded('gd')) {
            try {
                $webpPath = storage_path("app/public/{$folder}/{$uuid}.webp");
                $info = getimagesize($tempPath);
                $image = null;

                switch ($info['mime']) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($tempPath);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($tempPath);
                        break;
                    case 'image/gif':
                        $image = imagecreatefromgif($tempPath);
                        break;
                    case 'image/bmp':
                        $image = imagecreatefrombmp($tempPath);
                        break;
                }

                if ($image) {
                    $width = imagesx($image);
                    $height = imagesy($image);

                    if ($width > 1920) {
                        $ratio = 1920 / $width;
                        $newWidth = 1920;
                        $newHeight = (int)($height * $ratio);
                        $resampled = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($resampled, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagedestroy($image);
                        $image = $resampled;
                    }

                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                    $saved = imagewebp($image, $webpPath, 85);
                    imagedestroy($image);

                    if ($saved && file_exists($webpPath)) {
                        return [
                            'path' => "{$folder}/{$uuid}.webp",
                            'url' => asset('storage/' . "{$folder}/{$uuid}.webp")
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error('GD image processing failed: ' . $e->getMessage());
            }
        }

        $filename = $uuid . '.' . $extension;
        $path = $file->storeAs($folder, $filename, 'public');
        return ['path' => $path, 'url' => asset('storage/' . $path)];
    }

    private function processVideo(UploadedFile $file, string $folder, string $uuid, string $extension): array
    {
        $this->ensureDirectoryExists($folder);

        $filename = $uuid . '.' . $extension;
        $path = $file->storeAs($folder, $filename, 'public');
        return ['path' => $path, 'url' => asset('storage/' . $path)];
    }

    private function processPdf(UploadedFile $file, string $folder, string $uuid): array
    {
        $this->ensureDirectoryExists($folder);

        $filename = $uuid . '.pdf';
        $path = $file->storeAs($folder, $filename, 'public');
        return ['path' => $path, 'url' => asset('storage/' . $path)];
    }

    private function ensureDirectoryExists(string $folder): void
    {
        $path = storage_path("app/public/{$folder}");
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}