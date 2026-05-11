<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function index(): JsonResponse
    {
        $members = TeamMember::orderBy('display_order')->get();
        return response()->json(['data' => $members]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'bio_id' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'photo_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'display_order' => 'nullable|integer',
        ]);

        $data['display_order'] = $data['display_order'] ?? TeamMember::max('display_order') + 1;
        $member = TeamMember::create($data);
        return response()->json(['data' => $member, 'message' => 'Team member created'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $member = TeamMember::findOrFail($id);
        return response()->json(['data' => $member]);
    }

    public function update(Request $request, int $id): JsonResponse
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
            'display_order' => 'nullable|integer',
        ]);

        $member->update($data);
        return response()->json(['data' => $member, 'message' => 'Team member updated']);
    }

    public function destroy(int $id): JsonResponse
    {
        $member = TeamMember::findOrFail($id);
        $member->delete();
        return response()->json(['message' => 'Team member deleted']);
    }

    public function reorder(Request $request): JsonResponse
    {
        $data = $request->validate([
            'members' => 'required|array',
            'members.*.id' => 'required|integer',
            'members.*.display_order' => 'required|integer',
        ]);

        foreach ($data['members'] as $item) {
            TeamMember::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return response()->json(['message' => 'Order updated']);
    }
}