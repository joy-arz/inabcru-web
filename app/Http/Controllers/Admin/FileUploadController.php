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

        if ($type === 'image') {
            $result = $this->processImage($file, $folder, $uuid);
        } elseif ($type === 'video') {
            $result = $this->processVideo($file, $folder, $uuid);
        } elseif ($type === 'pdf') {
            $result = $this->processPdf($file, $folder, $uuid);
        } else {
            $filename = $uuid . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folder, $filename, 'public');
            $result = ['path' => $path, 'url' => asset('storage/' . $path)];
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

        if (!extension_loaded('gd') && !extension_loaded('imagick')) {
            $filename = $uuid . '.' . $extension;
            $path = $file->storeAs($folder, $filename, 'public');
            return ['path' => $path, 'url' => asset('storage/' . $path)];
        }

        $webpPath = storage_path("app/public/{$folder}/{$uuid}.webp");

        if ($extension === 'webp') {
            $filename = $uuid . '.webp';
            $path = $file->storeAs($folder, $filename, 'public');
            return ['path' => $path, 'url' => asset('storage/' . $path)];
        }

        $image = null;
        if (extension_loaded('imagick')) {
            $image = new \Imagick($tempPath);
            $image->setImageFormat('webp');
            $image->setImageQuality(85);
            $image->writeImage($webpPath);
            $image->destroy();
        } elseif (extension_loaded('gd')) {
            $info = getimagesize($tempPath);
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
                $webp = imagecreatetruecolor($width, $height);
                imagealphablending($webp, false);
                imagesavealpha($webp, true);
                imagecopy($webp, $image, 0, 0, 0, 0, $width, $height);
                imagewebp($webp, $webpPath, 85);
                imagedestroy($image);
                imagedestroy($webp);
            }
        }

        if (!file_exists($webpPath)) {
            $filename = $uuid . '.' . $extension;
            $path = $file->storeAs($folder, $filename, 'public');
            return ['path' => $path, 'url' => asset('storage/' . $path)];
        }

        $relativePath = "{$folder}/{$uuid}.webp";
        return [
            'path' => $relativePath,
            'url' => asset('storage/' . $relativePath),
            'original_name' => $file->getClientOriginalName()
        ];
    }

    private function processVideo(UploadedFile $file, string $folder, string $uuid): array
    {
        $extension = $file->getClientOriginalExtension();
        $originalFilename = $uuid . '.' . $extension;
        $tempPath = $file->getRealPath();

        if (extension_loaded('ffmpeg')) {
            $tempOutput = storage_path("app/temp/{$uuid}");
            if (!is_dir(dirname($tempOutput))) {
                mkdir(dirname($tempOutput), 0755, true);
            }

            $ffmpeg = \FFMPEG\FFMpeg::create();
            $video = $ffmpeg->open($tempPath);
            $video->filters()->resize(new \FFMPEG\Filter\Video\Scale(1280, 720));
            $video->save(new \FFMPEG\Format\Video\Webm(), $tempOutput . '.webm');

            if (file_exists($tempOutput . '.webm')) {
                $finalPath = storage_path("app/public/{$folder}/{$uuid}.webm");
                rename($tempOutput . '.webm', $finalPath);
                @unlink($tempPath);
                return [
                    'path' => "{$folder}/{$uuid}.webm",
                    'url' => asset('storage/' . "{$folder}/{$uuid}.webm")
                ];
            }
        }

        if (class_exists('\\App\\Services\\VideoCompressor')) {
            try {
                $compressed = \App\Services\VideoCompressor::compress($tempPath, $uuid, $folder);
                if ($compressed) {
                    return $compressed;
                }
            } catch (\Exception $e) {
            }
        }

        $filename = $originalFilename;
        $path = $file->storeAs($folder, $filename, 'public');
        return ['path' => $path, 'url' => asset('storage/' . $path)];
    }

    private function processPdf(UploadedFile $file, string $folder, string $uuid): array
    {
        $filename = $uuid . '.pdf';
        $tempPath = $file->getRealPath();

        if (extension_loaded('imagick')) {
            try {
                $pdf = new \Imagick($tempPath);
                $pdf->setResolution(150, 150);
                $pdf->setImageFormat('pdf');

                $compressedPath = storage_path("app/public/{$folder}/{$uuid}.pdf");
                $pdf->writeImages($compressedPath, true);
                $pdf->destroy();

                if (file_exists($compressedPath)) {
                    return [
                        'path' => "{$folder}/{$uuid}.pdf",
                        'url' => asset('storage/' . "{$folder}/{$uuid}.pdf")
                    ];
                }
            } catch (\Exception $e) {
            }
        }

        $path = $file->storeAs($folder, $filename, 'public');
        return ['path' => $path, 'url' => asset('storage/' . $path)];
    }
}