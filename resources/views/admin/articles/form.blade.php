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

    <div class="bg-white rounded-xl shadow-md p-6">
        <form method="POST" action="{{ isset($id) ? route('admin.articles.update', $id) : route('admin.articles.store') }}" class="space-y-6">
            @csrf
            @if(isset($id))
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Title (Indonesian)
                    </label>
                    <input type="text" name="title_id" value="{{ old('title_id', $article->title_id ?? '') }}" placeholder="Judul artikel dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Title (English)
                    </label>
                    <input type="text" name="title_en" value="{{ old('title_en', $article->title_en ?? '') }}" placeholder="Article title in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Content (Indonesian)
                    </label>
                    <textarea name="content_id" rows="6" placeholder="Konten artikel dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('content_id', $article->content_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Content (English)
                    </label>
                    <textarea name="content_en" rows="6" placeholder="Article content in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('content_en', $article->content_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Category</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                        <option value="news" {{ old('category', $article->category ?? '') == 'news' ? 'selected' : '' }}>News</option>
                        <option value="event" {{ old('category', $article->category ?? '') == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="update" {{ old('category', $article->category ?? '') == 'update' ? 'selected' : '' }}>Update</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Featured Image URL</label>
                    <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $article->featured_image_url ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <input type="checkbox" name="published" value="1" {{ old('published', $article->published ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary" />
                        Published
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.articles.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                    {{ isset($id) ? 'Update' : 'Create' }} Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection