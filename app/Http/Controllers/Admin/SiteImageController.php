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

    public function update(Request $request, int $id): JsonResponse|RedirectResponse
    {
        $image = SiteImage::findOrFail($id);

        $data = [];
        if ($request->has('image_url')) {
            $data['image_url'] = $request->input('image_url');
        }
        if ($request->has('alt_text')) {
            $data['alt_text'] = $request->input('alt_text');
        }
        if ($request->has('type')) {
            $data['type'] = $request->input('type');
        }

        $image->update($data);

        if ($request->hasHeader('Accept') && str_contains($request->header('Accept'), 'application/json')) {
            return response()->json(['success' => true]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.site-images.index')->with('success', 'Image updated');
    }
}