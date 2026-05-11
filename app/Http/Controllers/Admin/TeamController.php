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
        return view('admin.team.form');
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
            'linkedin_url' => 'nullable|string',
        ]);

        $data['display_order'] = TeamMember::max('display_order') + 1;
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added');
    }

    public function edit(int $id): View
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.form', ['member' => $member, 'id' => $id]);
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
            'linkedin_url' => 'nullable|string',
        ]);

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