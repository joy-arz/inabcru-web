@extends('layouts.admin')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.article-form .ql-toolbar { border-radius: 6px 6px 0 0; background: #f9fafb; }
.article-form .ql-container { border-radius: 0 0 6px 6px; font-size: 14px; }
.article-form .ql-editor { min-height: 180px; max-height: 320px; overflow-y: auto; }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'New' }} Article</h1>
            <p class="text-gray-500 text-sm mt-1">{{ isset($id) ? 'Update article details' : 'Create a new article' }}</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors text-sm">
            Cancel
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ isset($id) ? route('admin.articles.update', $id) : route('admin.articles.store') }}" id="article-form">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-heading text-lg font-semibold text-gray-900 mb-4">Details</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title (ID)</label>
                                <input type="text" name="title_id" id="title_id" value="{{ old('title_id', $article->title_id ?? '') }}" placeholder="Judul dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title (EN)</label>
                                <input type="text" name="title_en" value="{{ old('title_en', $article->title_en ?? '') }}" placeholder="Title in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400 text-sm">/news/</span>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug ?? '') }}" placeholder="auto-generated-from-title" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none font-mono text-sm" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Location (ID)</label>
                                <input type="text" name="meta_location_id" value="{{ old('meta_location_id', $article->meta_location_id ?? '') }}" placeholder="e.g., Jakarta" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Location (EN)</label>
                                <input type="text" name="meta_location_en" value="{{ old('meta_location_en', $article->meta_location_en ?? '') }}" placeholder="e.g., Jakarta" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                                    <option value="news" {{ old('category', $article->category ?? 'news') == 'news' ? 'selected' : '' }}>News</option>
                                    <option value="event" {{ old('category', $article->category ?? '') == 'event' ? 'selected' : '' }}>Event</option>
                                    <option value="update" {{ old('category', $article->category ?? '') == 'update' ? 'selected' : '' }}>Update</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                                <div class="flex items-center gap-3">
                                    <label class="px-4 py-2.5 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 text-sm">
                                        Choose File
                                        <input type="file" name="featured_image_file" id="featured_image_file" accept="image/*" class="hidden" onchange="handleImageUpload(this, 'featured_image_url', 'featured_preview')" />
                                    </label>
                                </div>
                                <input type="hidden" name="featured_image_url" id="featured_image_url" value="{{ old('featured_image_url', $article->featured_image_url ?? '') }}">
                                <div id="featured_preview" class="mt-2 {{ isset($article->featured_image_url) && $article->featured_image_url ? '' : 'hidden' }}">
                                    <img src="{{ $article->featured_image_url ?? '' }}" alt="" class="h-20 object-cover rounded border" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b bg-gray-50 rounded-t-xl">
                        <h2 class="font-heading text-lg font-semibold text-gray-900">Content</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">🇮🇩 Bahasa Indonesia</label>
                            <div class="article-form border border-gray-200 rounded-b-lg overflow-hidden">
                                <div id="editor_id">{!! old('content_id', $article->content_id ?? '') !!}</div>
                                <input type="hidden" name="content_id" id="content_id_input">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">🇬🇧 English</label>
                            <div class="article-form border border-gray-200 rounded-b-lg overflow-hidden">
                                <div id="editor_en">{!! old('content_en', $article->content_en ?? '') !!}</div>
                                <input type="hidden" name="content_en" id="content_en_input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-heading text-lg font-semibold text-gray-900 mb-4">Publish</h2>
                    <div class="space-y-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="published" id="published" value="1" {{ old('published', $article->published ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary" />
                            <span class="text-sm font-medium text-gray-700">Published</span>
                        </label>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Publish Date</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.articles.index') }}" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-center text-gray-600 text-sm font-medium transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 text-center text-sm font-medium transition-colors">
                        {{ isset($id) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var quillOptions = {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image'],
                [{ 'align': [] }],
                ['blockquote'],
                ['clean']
            ]
        }
    };

    var quillId = new Quill('#editor_id', quillOptions);
    var quillEn = new Quill('#editor_en', quillOptions);

    document.getElementById('title_id').addEventListener('input', function() {
        var slug = document.getElementById('slug');
        if (!slug.value || slug.dataset.auto === 'true') {
            slug.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            slug.dataset.auto = 'true';
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.auto = 'false';
    });

    document.getElementById('article-form').addEventListener('submit', function() {
        document.getElementById('content_id_input').value = quillId.root.innerHTML;
        document.getElementById('content_en_input').value = quillEn.root.innerHTML;
    });
});

function handleImageUpload(input, targetInputId, previewId) {
    var file = input.files[0];
    if (!file) return;
    if (file.size > 10 * 1024 * 1024) {
        alert('File too large. Max 10MB');
        input.value = '';
        return;
    }
    var formData = new FormData();
    formData.append('file', file);
    formData.append('type', 'image');
    formData.append('_token', '{{ csrf_token() }}');
    fetch('{{ route('admin.upload') }}', {
        method: 'POST',
        body: formData
    }).then(function(res) { return res.json(); }).then(function(data) {
        if (data.error) { alert(data.error); return; }
        document.getElementById(targetInputId).value = data.url;
        var preview = document.getElementById(previewId);
        preview.querySelector('img').src = data.url;
        preview.classList.remove('hidden');
    }).catch(function() { alert('Upload failed'); });
}
</script>
@endpush
@endsection