@extends('layouts.admin')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.article-form .ql-toolbar { border-radius: 6px 6px 0 0; background: #f9fafb; }
.article-form .ql-container { border-radius: 0 0 6px 6px; font-size: 14px; }
.article-form .ql-editor { min-height: 180px; max-height: 320px; overflow-y: auto; }
.article-form .ql-editor iframe { width: 100%; aspect-ratio: 16/9; border-radius: 8px; }
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
                                        <input type="file" name="featured_image_file" id="featured_image_file" accept="image/*" class="hidden" onchange="handleImageUpload(this, 'featured_image_url', 'featured_preview', 'featured_progress')" />
                                    </label>
                                </div>
                                <div id="featured_progress" class="mt-2 hidden">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div id="featured_progress_bar" class="bg-primary h-2.5 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1" id="featured_progress_text">Uploading 0%</p>
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
                    <h2 class="font-heading text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                    <input type="hidden" name="published" id="published_value" value="{{ isset($id) && $article->published ? '1' : '0' }}">
                    <div class="space-y-3">
                        <button type="submit" onclick="setPublishAction('0')" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-center text-gray-600 text-sm font-medium transition-colors">
                            Save as Draft
                        </button>
                        <button type="submit" onclick="setPublishAction('1')" class="w-full px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 text-center text-sm font-medium transition-colors">
                            Publish
                        </button>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.articles.index') }}" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-center text-gray-600 text-sm font-medium transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
function extractYouTubeId(url) {
  var patterns = [
    /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/
  ];
  for (var i = 0; i < patterns.length; i++) {
    var match = url.match(patterns[i]);
    if (match) return match[1];
  }
  return null;
}

function convertYoutubeLinksToEmbeds(content) {
  return content;
}

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
    
    quillId.root.style.textAlign = 'justify';
    quillEn.root.style.textAlign = 'justify';
    
    quillId.on('text-change', function() {
        quillId.root.style.textAlign = 'justify';
    });
    quillEn.on('text-change', function() {
        quillEn.root.style.textAlign = 'justify';
    });
    
    function addYoutubeButton(quillInstance, label) {
        var toolbar = quillInstance.getModule('toolbar').container;
        
        var btn = document.createElement('button');
        btn.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="#FF0000"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>';
        btn.title = 'Insert YouTube Video (' + label + ')';
        btn.className = 'ql-insertYoutube';
        btn.type = 'button';
        btn.style.cssText = 'background: none; border: none; cursor: pointer; padding: 0 4px;';
        btn.addEventListener('click', function() {
            var url = prompt('Enter YouTube URL for ' + label + ':');
            if (url) {
                var id = extractYouTubeId(url);
                if (id) {
                    var iframe = '<p><iframe src="https://www.youtube.com/embed/' + id + '" class="w-full aspect-video" frameborder="0" allowfullscreen></iframe></p>';
                    var range = quillInstance.getSelection(true) || { index: quillInstance.getLength() };
                    quillInstance.clipboard.dangerouslyPasteHTML(range.index, iframe);
                } else {
                    alert('Invalid YouTube URL');
                }
            }
        });
        
        var cleanBtn = toolbar.querySelector('.ql-clean');
        if (cleanBtn && cleanBtn.parentNode === toolbar) {
            toolbar.insertBefore(btn, cleanBtn);
        } else {
            toolbar.appendChild(btn);
        }
    }
    
    addYoutubeButton(quillId, 'Indonesian');
    addYoutubeButton(quillEn, 'English');

    function handlePaste(e, quillInstance) {
        var clipboardData = e.originalEvent.clipboardData;
        if (!clipboardData) return;
        
        var text = clipboardData.getData('text');
        if (!text) return;
        
        var id = extractYouTubeId(text.trim());
        if (id && text.trim().match(/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v|youtu\.be|youtube\.com\/embed|youtube\.com\/shorts)\/.+/)) {
            e.preventDefault();
            var iframe = '<p><iframe src="https://www.youtube.com/embed/' + id + '" class="w-full aspect-video" frameborder="0" allowfullscreen></iframe></p>';
            var range = quillInstance.getSelection(true) || { index: quillInstance.getLength() };
            quillInstance.clipboard.dangerouslyPasteHTML(range.index, iframe);
        }
    }
    
    quillId.container.addEventListener('paste', function(e) { handlePaste(e, quillId); });
    quillEn.container.addEventListener('paste', function(e) { handlePaste(e, quillEn); });

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
        var idContent = convertYoutubeLinksToEmbeds(quillId.root.innerHTML);
        var enContent = convertYoutubeLinksToEmbeds(quillEn.root.innerHTML);
        document.getElementById('content_id_input').value = idContent;
        document.getElementById('content_en_input').value = enContent;
    });

    window.setPublishAction = function(value) {
        document.getElementById('published_value').value = value;
        document.getElementById('article-form').submit();
    };
});

function handleImageUpload(input, targetInputId, previewId, progressId) {
    var file = input.files[0];
    if (!file) return;
    if (file.size > 10 * 1024 * 1024) {
        alert('File too large. Max 10MB');
        input.value = '';
        return;
    }
    
    var progressContainer = progressId ? document.getElementById(progressId) : null;
    var progressBar = progressId ? document.getElementById(progressId + '_bar') : null;
    var progressText = progressId ? document.getElementById(progressId + '_text') : null;
    
    if (progressContainer) {
        progressContainer.classList.remove('hidden');
        if (progressBar) progressBar.style.width = '0%';
        if (progressText) progressText.textContent = 'Uploading 0%';
    }
    
    var formData = new FormData();
    formData.append('file', file);
    formData.append('type', 'image');
    formData.append('_token', '{{ csrf_token() }}');
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('admin.upload') }}', true);
    
    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable && progressBar && progressText) {
            var percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressText.textContent = 'Uploading ' + percent + '%';
        }
    });
    
    xhr.addEventListener('load', function() {
        if (progressContainer) progressContainer.classList.add('hidden');
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.error) { alert(data.error); return; }
            document.getElementById(targetInputId).value = data.url;
            var preview = document.getElementById(previewId);
            preview.querySelector('img').src = data.url;
            preview.classList.remove('hidden');
        } else {
            alert('Upload failed');
        }
    });
    
    xhr.addEventListener('error', function() {
        if (progressContainer) progressContainer.classList.add('hidden');
        alert('Upload failed');
    });
    
    xhr.send(formData);
}
</script>
@endpush
@endsection