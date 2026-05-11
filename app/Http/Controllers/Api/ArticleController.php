<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::where('published', true)->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $articles]);
    }

    public function adminIndex(): JsonResponse
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $articles]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'category' => 'nullable|string',
            'featured_image_url' => 'nullable|string',
            'slug' => 'nullable|string',
            'published' => 'nullable|boolean',
        ]);

        $article = Article::create($data);
        return response()->json(['data' => $article, 'message' => 'Article created'], 201);
    }

    public function show(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        return response()->json(['data' => $article]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        $data = $request->validate([
            'title_id' => 'sometimes|string',
            'title_en' => 'sometimes|string',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'category' => 'nullable|string',
            'featured_image_url' => 'nullable|string',
            'slug' => 'nullable|string',
            'published' => 'nullable|boolean',
        ]);

        $article->update($data);
        return response()->json(['data' => $article, 'message' => 'Article updated']);
    }

    public function destroy(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted']);
    }
}