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
            <h2 class="font-heading text-lg font-semibold text-text-main flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Article Details
            </h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Title (Indonesian)
                    </label>
                    <input type="text" name="title_id" id="title_id" value="{{ old('title_id', $article->title_id ?? '') }}" placeholder="Judul artikel dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Title (English)
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Location (ID)
                    </label>
                    <input type="text" name="meta_location_id" value="{{ old('meta_location_id', $article->meta_location_id ?? '') }}" placeholder="e.g., Jakarta, Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Location (EN)
                    </label>
                    <input type="text" name="meta_location_en" value="{{ old('meta_location_en', $article->meta_location_en ?? '') }}" placeholder="e.g., Jakarta, Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Category</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                        <option value="news" {{ old('category', $article->category ?? 'news') == 'news' ? 'selected' : '' }}>News</option>
                        <option value="event" {{ old('category', $article->category ?? '') == 'event' ? 'selected' : '' }}>Event</option>
                        <option value="update" {{ old('category', $article->category ?? '') == 'update' ? 'selected' : '' }}>Update</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Featured Image</label>
                    <div class="flex items-center gap-3">
                        <label class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span class="text-sm">Upload</span>
                            <input type="file" name="featured_image_file" id="featured_image_file" accept="image/*" class="hidden" onchange="handleImageUpload(this, 'featured_image_url', 'featured_preview')" />
                        </label>
                        <span class="text-xs text-gray-400">JPG, PNG, WEBP, GIF (max 5MB)</span>
                    </div>
                </div>
            </div>

            <input type="hidden" name="featured_image_url" id="featured_image_url" value="{{ old('featured_image_url', $article->featured_image_url ?? '') }}">

            <div id="featured_preview" class="mt-2 {{ isset($article->featured_image_url) && $article->featured_image_url ? '' : 'hidden' }}">
                <img src="{{ $article->featured_image_url ?? '' }}" alt="Cover preview" class="w-48 h-32 object-cover rounded-lg border border-gray-200" />
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b bg-gray-50 px-6 py-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l4.586-4.586z"></path></svg>
                    <h2 class="font-heading text-lg font-semibold text-text-main">Article Content</h2>
                </div>
                <p class="text-sm text-gray-500 mt-1">Write content in both languages using rich text editor</p>
            </div>

            <div class="grid grid-cols-2 divide-x">
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium text-text-main">Bahasa Indonesia</span>
                    </div>
                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 p-2 flex flex-wrap gap-1">
                            <button type="button" onclick="formatText('content_id', 'bold')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_id', 'italic')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Italic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4m-2 0v16m-4 0h8"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_id', 'underline')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 20h16M7 4v8a5 5 0 0010 0V4"></path></svg>
                            </button>
                            <span class="w-px h-6 bg-gray-300"></span>
                            <button type="button" onclick="formatText('content_id', 'insertUnorderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bullet List">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_id', 'insertOrderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Numbered List">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10"></path></svg>
                            </button>
                            <span class="w-px h-6 bg-gray-300"></span>
                            <button type="button" onclick="formatText('content_id', 'createLink', prompt('Enter URL:'))" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Link">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </button>
                            <button type="button" onclick="insertImage('content_id')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Insert Image">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </button>
                            <button type="button" onclick="formatText('content_id', 'formatBlock', 'h2')" class="p-2 hover:bg-gray-200 rounded transition-colors font-bold" title="Heading">H2</button>
                            <button type="button" onclick="formatText('content_id', 'formatBlock', 'h3')" class="p-2 hover:bg-gray-200 rounded transition-colors font-bold" title="Subheading">H3</button>
                        </div>
                        <div id="editor_id" class="prose prose-sm p-4 min-h-[200px] focus:outline-none" contenteditable="true" oninput="updateHiddenContent('content_id')">{{ old('content_id', $article->content_id ?? '') }}</div>
                        <input type="hidden" name="content_id" id="content_id_input" value="{{ old('content_id', $article->content_id ?? '') }}">
                    </div>
                </div>

                <div class="p-4 bg-gray-50/50">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium text-text-main">English</span>
                    </div>
                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 p-2 flex flex-wrap gap-1">
                            <button type="button" onclick="formatText('content_en', 'bold')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_en', 'italic')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Italic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4m-2 0v16m-4 0h8"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_en', 'underline')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 20h16M7 4v8a5 5 0 0010 0V4"></path></svg>
                            </button>
                            <span class="w-px h-6 bg-gray-300"></span>
                            <button type="button" onclick="formatText('content_en', 'insertUnorderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Bullet List">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <button type="button" onclick="formatText('content_en', 'insertOrderedList')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Numbered List">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10"></path></svg>
                            </button>
                            <span class="w-px h-6 bg-gray-300"></span>
                            <button type="button" onclick="formatText('content_en', 'createLink', prompt('Enter URL:'))" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Link">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </button>
                            <button type="button" onclick="insertImage('content_en')" class="p-2 hover:bg-gray-200 rounded transition-colors" title="Insert Image">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </button>
                            <button type="button" onclick="formatText('content_en', 'formatBlock', 'h2')" class="p-2 hover:bg-gray-200 rounded transition-colors font-bold" title="Heading">H2</button>
                            <button type="button" onclick="formatText('content_en', 'formatBlock', 'h3')" class="p-2 hover:bg-gray-200 rounded transition-colors font-bold" title="Subheading">H3</button>
                        </div>
                        <div id="editor_en" class="prose prose-sm p-4 min-h-[200px] focus:outline-none" contenteditable="true" oninput="updateHiddenContent('content_en')">{{ old('content_en', $article->content_en ?? '') }}</div>
                        <input type="hidden" name="content_en" id="content_en_input" value="{{ old('content_en', $article->content_en ?? '') }}">
                    </div>
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

    function handleImageUpload(input, targetInputId, previewId) {
        const file = input.files[0];
        if (!file) return;
        if (file.size > 10 * 1024 * 1024) {
            alert('File too large. Max 10MB');
            input.value = '';
            return;
        }
        const formData = new FormData();
        formData.append('file', file);
        formData.append('type', 'image');
        formData.append('_token', '{{ csrf_token() }}');
        fetch('{{ route('admin.upload') }}', {
            method: 'POST',
            body: formData
        }).then(res => res.json()).then(data => {
            if (data.error) { alert(data.error); return; }
            document.getElementById(targetInputId).value = data.url;
            const preview = document.getElementById(previewId);
            const previewImg = preview.querySelector('img');
            previewImg.src = data.url;
            preview.classList.remove('hidden');
        }).catch(() => alert('Upload failed'));
    }

    function formatText(editorId, command, value) {
        event.preventDefault();
        document.execCommand(command, false, value || null);
        document.getElementById(editorId).focus();
    }

    function insertImage(editorId) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (file.size > 10 * 1024 * 1024) {
                alert('File too large. Max 10MB');
                return;
            }
            const formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'image');
            formData.append('_token', '{{ csrf_token() }}');
            fetch('{{ route('admin.upload') }}', {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                if (data.error) { alert(data.error); return; }
                const editor = document.getElementById('editor_' + editorId);
                const imgHtml = '<img src="' + data.url + '" alt="" style="max-width:100%;height:auto;border-radius:8px;margin:16px 0;" />';
                document.execCommand('insertHTML', false, imgHtml);
                updateHiddenContent(editorId);
            }).catch(() => alert('Upload failed'));
        };
        input.click();
    }

    function updateHiddenContent(lang) {
        const editor = document.getElementById('editor_' + lang);
        const hiddenInput = document.getElementById(lang + '_input');
        if (editor && hiddenInput) {
            hiddenInput.value = editor.innerHTML;
        }
    }

    function initEditors() {
        updateHiddenContent('content_id');
        updateHiddenContent('content_en');
    }

    document.addEventListener('DOMContentLoaded', initEditors);
    </script>
</div>
@endsection