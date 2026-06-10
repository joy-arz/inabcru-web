<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'required|string',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'category' => 'nullable|string',
            'featured_image_url' => 'nullable|string',
            'slug' => 'nullable|string',
            'meta_location_id' => 'nullable|string',
            'meta_location_en' => 'nullable|string',
            'published' => 'nullable|string',
            'published_at' => 'nullable|date',
            'published_at' => 'nullable|date',
        ]);

        $isPublishing = $request->input('published') === '1';
        $data['published'] = $isPublishing;

        if ($isPublishing && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if (empty($data['slug']) && !empty($data['title_id'])) {
            $data['slug'] = Str::slug($data['title_id']);
        }

        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Article created');
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.form', ['article' => $article, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
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
            'meta_location_id' => 'nullable|string',
            'meta_location_en' => 'nullable|string',
            'published' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $isPublishing = $request->input('published') === '1';
        $data['published'] = $isPublishing;

        if ($isPublishing && empty($article->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if (empty($data['slug']) && !empty($data['title_id'])) {
            $data['slug'] = Str::slug($data['title_id']);
        }

        $article->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Article updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted');
    }
}