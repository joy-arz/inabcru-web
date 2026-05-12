@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'New' }} Article</h1>
            <p class="text-gray-500 mt-1">{{ isset($id) ? 'Update the article details' : 'Create a new news article' }}</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-gray-700">
            <button class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </button>
        </a>
    </div>

    @if($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ isset($id) ? route('admin.articles.update', $id) : route('admin.articles.store') }}" class="space-y-6">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-md p-6 space-y-6">
            <h2 class="font-heading text-lg font-semibold text-text-main">Article Details</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Title (Indonesian)
                    </label>
                    <input type="text" name="title_id" id="title_id" value="{{ old('title_id', $article->title_id ?? '') }}" placeholder="Judul artikel dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Title (English)
                    </label>
                    <input type="text" name="title_en" value="{{ old('title_en', $article->title_en ?? '') }}" placeholder="Article title in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">URL Slug</label>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400">/news/</span>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug ?? '') }}" placeholder="article-url-slug" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all font-mono" />
                </div>
                <p class="text-xs text-gray-500">Leave empty to auto-generate from Indonesian title</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Location (ID)
                    </label>
                    <input type="text" name="meta_location_id" value="{{ old('meta_location_id', $article->meta_location_id ?? '') }}" placeholder="e.g., Jakarta, Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Location (EN)
                    </label>
                    <input type="text" name="meta_location_en" value="{{ old('meta_location_en', $article->meta_location_en ?? '') }}" placeholder="e.g., Jakarta, Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Category</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                        <option value="news" {{ old('category', $article->category ?? 'news') == 'news' ? 'selected' : '' }}>News</option>
                        <option value="event" {{ old('category', $article->category ?? '') == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="update" {{ old('category', $article->category ?? '') == 'update' ? 'selected' : '' }}>Update</option>
                    </select>
                </div>
                <div class="space-y-2 col-span-2">
                    <label class="text-sm font-medium text-gray-700">Featured Image URL</label>
                    <input type="url" name="featured_image_url" id="featured_image_url" value="{{ old('featured_image_url', $article->featured_image_url ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>

            @if(isset($article->featured_image_url) && $article->featured_image_url)
            <div class="mt-2">
                <img src="{{ $article->featured_image_url }}" alt="Cover preview" class="w-48 h-32 object-cover rounded-lg border border-gray-200" />
            </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b bg-gray-50 px-6 py-4">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">📝</span>
                    <h2 class="font-heading text-lg font-semibold text-text-main">Article Content</h2>
                </div>
                <p class="text-sm text-gray-500 mt-1">Write content in both languages</p>
            </div>

            <div class="grid grid-cols-2 divide-x">
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl">🇮🇩</span>
                        <span class="font-medium text-text-main">Bahasa Indonesia</span>
                    </div>
                    <textarea name="content_id" rows="10" placeholder="Konten artikel dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('content_id', $article->content_id ?? '') }}</textarea>
                </div>

                <div class="p-4 bg-gray-50/50">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl">🇬🇧</span>
                        <span class="font-medium text-text-main">English</span>
                    </div>
                    <textarea name="content_en" rows="10" placeholder="Article content in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('content_en', $article->content_en ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="published" id="published" value="1" {{ old('published', $article->published ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary" />
                    <label for="published" class="text-sm font-medium text-gray-700">Published</label>
                </div>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d\TH:i') : '') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('admin.articles.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                {{ isset($id) ? 'Update' : 'Create' }} Article
            </button>
        </div>
    </form>

    <script>
    document.getElementById('title_id').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.auto === 'true') {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-|-$/g, '');
            slugInput.dataset.auto = 'true';
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.auto = 'false';
    });
    </script>
</div>
@endsection