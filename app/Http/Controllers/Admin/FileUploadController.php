<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        if (!$file) {
            return response()->json(['error' => 'No file provided'], 400);
        }

        $type = $request->input('type', 'image');

        $maxSizes = [
            'image' => 20 * 1024 * 1024,
            'video' => 500 * 1024 * 1024,
            'pdf' => 250 * 1024 * 1024,
        ];

        $maxSize = $maxSizes[$type] ?? 10 * 1024 * 1024;

        if ($file->getSize() > $maxSize) {
            return response()->json(['error' => 'File too large'], 400);
        }

        $allowedMimes = [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
            'video' => ['mp4', 'webm', 'mov', 'avi'],
            'pdf' => ['pdf'],
        ];

        $allowed = $allowedMimes[$type] ?? ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed)) {
            return response()->json(['error' => 'Invalid file type'], 400);
        }

        $folder = "uploads/{$type}s";
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $filename, 'public');

        $url = asset('storage/' . $path);

        return response()->json(['url' => $url, 'path' => $path]);
    }
}