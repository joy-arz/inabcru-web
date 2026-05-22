<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function index(): View
    {
        $images = SiteImage::orderBy('category')->orderBy('key')->get();
        $grouped = $images->groupBy('category');
        return view('admin.site-images.index', compact('images', 'grouped'));
    }

    public function edit(int $id): View
    {
        $image = SiteImage::findOrFail($id);
        return view('admin.site-images.form', ['image' => $image, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $image = SiteImage::findOrFail($id);
        $data = $request->validate([
            'image_url' => 'sometimes|string',
            'alt_text' => 'nullable|string',
            'type' => 'sometimes|string|in:image,video',
        ]);

        $image->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.site-images.index')->with('success', 'Image updated');
    }
}