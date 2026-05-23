<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function index(): View
    {
        $divisions = Division::orderBy('display_order')->get();
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create(): View
    {
        return view('admin.divisions.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name_id' => 'required|string|max:100',
            'name_en' => 'required|string|max:100',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name_id']);
        $data['display_order'] = $data['display_order'] ?? Division::max('display_order') + 1;
        $data['active'] = $data['active'] ?? true;
        Division::create($data);
        return redirect()->route('admin.divisions.index')->with('success', 'Division added');
    }

    public function edit(int $id): View
    {
        $division = Division::findOrFail($id);
        return view('admin.divisions.form', ['division' => $division, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $division = Division::findOrFail($id);
        $data = $request->validate([
            'name_id' => 'sometimes|string|max:100',
            'name_en' => 'sometimes|string|max:100',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        if (isset($data['name_id'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name_id']);
        }
        $division->update($data);
        return redirect()->route('admin.divisions.index')->with('success', 'Division updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $division = Division::findOrFail($id);
        $division->delete();
        return redirect()->route('admin.divisions.index')->with('success', 'Division deleted');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'items' => 'required|array',
        ]);

        foreach ($data['items'] as $item) {
            Division::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return redirect()->back()->with('success', 'Order updated');
    }
}