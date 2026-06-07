<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicationSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicationSectionController extends Controller
{
    public function index(): View
    {
        $sections = PublicationSection::orderBy('display_order')->get();
        return view('admin.publications.sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin.publications.sections.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'display_order' => 'nullable|integer',
        ]);

        PublicationSection::create($data);
        return redirect()->route('admin.publication-sections.index')->with('success', 'Section created');
    }

    public function edit(int $id): View
    {
        $section = PublicationSection::findOrFail($id);
        return view('admin.publications.sections.form', ['section' => $section, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $section = PublicationSection::findOrFail($id);
        $data = $request->validate([
            'title_id' => 'sometimes|string',
            'title_en' => 'sometimes|string',
            'display_order' => 'nullable|integer',
        ]);

        $section->update($data);
        return redirect()->route('admin.publication-sections.index')->with('success', 'Section updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $section = PublicationSection::findOrFail($id);
        $section->delete();
        return redirect()->route('admin.publication-sections.index')->with('success', 'Section deleted');
    }
}
