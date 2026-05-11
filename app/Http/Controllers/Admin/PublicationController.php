<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicationController extends Controller
{
    public function index(): View
    {
        $publications = Publication::orderBy('year', 'desc')->get();
        return view('admin.publications.index', compact('publications'));
    }

    public function create(): View
    {
        return view('admin.publications.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'abstract_id' => 'nullable|string',
            'abstract_en' => 'nullable|string',
            'journal' => 'nullable|string',
            'year' => 'nullable|integer',
            'doi' => 'nullable|string',
            'cover_image_url' => 'nullable|string',
        ]);

        Publication::create($data);
        return redirect()->route('admin.publications.index')->with('success', 'Publication created');
    }

    public function edit(int $id): View
    {
        $publication = Publication::findOrFail($id);
        return view('admin.publications.form', ['publication' => $publication, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $publication = Publication::findOrFail($id);
        $data = $request->validate([
            'title_id' => 'sometimes|string',
            'title_en' => 'sometimes|string',
            'abstract_id' => 'nullable|string',
            'abstract_en' => 'nullable|string',
            'journal' => 'nullable|string',
            'year' => 'nullable|integer',
            'doi' => 'nullable|string',
            'cover_image_url' => 'nullable|string',
        ]);

        $publication->update($data);
        return redirect()->route('admin.publications.index')->with('success', 'Publication updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return redirect()->route('admin.publications.index')->with('success', 'Publication deleted');
    }
}