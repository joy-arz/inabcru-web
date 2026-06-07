<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $team = TeamMember::orderBy('display_order')->get();
        return view('admin.team.index', compact('team'));
    }

    public function create(): View
    {
        try {
            $divisions = \App\Models\Division::where('active', true)->orderBy('display_order')->get();
        } catch (\Exception $e) {
            $divisions = collect([]);
        }
        return view('admin.team.form', compact('divisions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'bio_id' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'photo_url' => 'nullable|string',
            'photo_focal_x' => 'nullable|numeric|min:0|max:100',
            'photo_focal_y' => 'nullable|numeric|min:0|max:100',
            'linkedin_url' => 'nullable|string',
            'division_id' => 'nullable|integer',
            'role' => 'nullable|string',
        ]);

        $data['display_order'] = TeamMember::max('display_order') + 1;
        if (empty($data['division_id'])) {
            unset($data['division_id']);
        }
        $data['photo_focal_x'] = is_numeric($data['photo_focal_x'] ?? null) ? $data['photo_focal_x'] : 50;
        $data['photo_focal_y'] = is_numeric($data['photo_focal_y'] ?? null) ? $data['photo_focal_y'] : 50;
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added');
    }

    public function edit(int $id): View
    {
        $member = TeamMember::findOrFail($id);
        $divisions = collect([]);
        try {
            $divisions = \App\Models\Division::where('active', true)->orderBy('display_order')->get();
        } catch (\Exception $e) {
            // divisions table may not exist
        }
        return view('admin.team.form', ['member' => $member, 'divisions' => $divisions, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $member = TeamMember::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|string',
            'title_id' => 'sometimes|string',
            'title_en' => 'sometimes|string',
            'bio_id' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'photo_url' => 'nullable|string',
            'photo_focal_x' => 'nullable|numeric|min:0|max:100',
            'photo_focal_y' => 'nullable|numeric|min:0|max:100',
            'linkedin_url' => 'nullable|string',
            'division_id' => 'nullable|integer',
            'role' => 'nullable|string',
        ]);

        if (isset($data['division_id']) && empty($data['division_id'])) {
            unset($data['division_id']);
        }
        $data['photo_focal_x'] = is_numeric($data['photo_focal_x'] ?? null) ? $data['photo_focal_x'] : 50;
        $data['photo_focal_y'] = is_numeric($data['photo_focal_y'] ?? null) ? $data['photo_focal_y'] : 50;
        $member->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $member = TeamMember::findOrFail($id);
        $member->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'members' => 'required|array',
        ]);

        foreach ($data['members'] as $item) {
            TeamMember::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return redirect()->back()->with('success', 'Order updated');
    }
}