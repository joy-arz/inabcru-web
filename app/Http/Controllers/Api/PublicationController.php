<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PublicationController extends Controller
{
    public function index(): JsonResponse
    {
        $publications = Publication::orderBy('year', 'desc')->get();
        return response()->json(['data' => $publications]);
    }

    public function store(Request $request): JsonResponse
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

        $publication = Publication::create($data);
        return response()->json(['data' => $publication, 'message' => 'Publication created'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $publication = Publication::findOrFail($id);
        return response()->json(['data' => $publication]);
    }

    public function update(Request $request, int $id): JsonResponse
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
        return response()->json(['data' => $publication, 'message' => 'Publication updated']);
    }

    public function destroy(int $id): JsonResponse
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return response()->json(['message' => 'Publication deleted']);
    }
}