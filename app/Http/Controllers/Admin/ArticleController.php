<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            'published' => 'nullable|boolean',
        ]);

        $data['published'] = $request->has('published');
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
            'published' => 'nullable|boolean',
        ]);

        $data['published'] = $request->has('published');
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