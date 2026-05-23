<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::with('division')->orderBy('display_order')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        $divisions = Division::where('active', true)->orderBy('display_order')->get();
        return view('admin.programs.form', compact('divisions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'title_id' => 'required|string|max:200',
            'title_en' => 'required|string|max:200',
            'short_description_id' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'featured_image_url' => 'nullable|string',
            'featured_image_alt' => 'nullable|string',
            'carousel_images' => 'nullable',
            'display_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['title_id']);
        $data['display_order'] = $data['display_order'] ?? Program::max('display_order') + 1;
        $data['active'] = $data['active'] ?? true;
        if (isset($data['carousel_images'])) {
            if (is_string($data['carousel_images'])) {
                $data['carousel_images'] = json_decode($data['carousel_images'], true) ?? [];
            }
            $data['carousel_images'] = json_encode($data['carousel_images']);
        }
        Program::create($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program added');
    }

    public function edit(int $id): View
    {
        $program = Program::findOrFail($id);
        $divisions = Division::where('active', true)->orderBy('display_order')->get();
        return view('admin.programs.form', ['program' => $program, 'divisions' => $divisions, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $program = Program::findOrFail($id);
        $data = $request->validate([
            'division_id' => 'sometimes|exists:divisions,id',
            'title_id' => 'sometimes|string|max:200',
            'title_en' => 'sometimes|string|max:200',
            'short_description_id' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'featured_image_url' => 'nullable|string',
            'featured_image_alt' => 'nullable|string',
            'carousel_images' => 'nullable',
            'display_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        if (isset($data['title_id'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title_id']);
        }
        if (isset($data['carousel_images'])) {
            if (is_string($data['carousel_images'])) {
                $data['carousel_images'] = json_decode($data['carousel_images'], true) ?? [];
            }
            $data['carousel_images'] = json_encode($data['carousel_images']);
        }
        $program->update($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'items' => 'required|array',
        ]);

        foreach ($data['items'] as $item) {
            Program::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return redirect()->back()->with('success', 'Order updated');
    }
}