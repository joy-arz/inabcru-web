@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.publications.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="font-heading text-3xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'New' }} Publication</h1>
                <p class="text-gray-500 mt-1">Manage publication metadata and media blocks</p>
            </div>
        </div>
        <button type="submit" form="pub-form" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ isset($id) ? 'Update' : 'Create' }} Publication
        </button>
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

    <form id="pub-form" method="POST" action="{{ isset($id) ? route('admin.publications.update', $id) : route('admin.publications.store') }}" class="space-y-6">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <input type="hidden" name="content_blocks" id="content_blocks_json" value="{{ old('content_blocks', isset($publication) ? json_encode($publication->content_blocks ?? []) : '[]') }}">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-md p-6 space-y-6">
                    <h2 class="font-heading text-lg font-semibold text-text-main flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Metadata
                    </h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Title (Indonesian)
                            </label>
                            <input type="text" name="title_id" value="{{ old('title_id', $publication->title_id ?? '') }}" placeholder="Judul publikasi" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                        </div>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Title (English)
                            </label>
                            <input type="text" name="title_en" value="{{ old('title_en', $publication->title_en ?? '') }}" placeholder="Publication title" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Journal / Source</label>
                            <input type="text" name="journal" value="{{ old('journal', $publication->journal ?? '') }}" placeholder="Journal name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Year</label>
                            <select name="year" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                                @for($y = date('Y'); $y >= 1900; $y--)
                                    <option value="{{ $y }}" {{ old('year', $publication->year ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">DOI</label>
                        <input type="text" name="doi" value="{{ old('doi', $publication->doi ?? '') }}" placeholder="https://doi.org/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Abstract (ID)
                            </label>
                            <textarea name="abstract_id" rows="3" placeholder="Abstrak dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('abstract_id', $publication->abstract_id ?? '') }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Abstract (EN)
                            </label>
                            <textarea name="abstract_en" rows="3" placeholder="Abstract in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('abstract_en', $publication->abstract_en ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="border-b bg-gray-50 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="font-heading text-lg font-semibold text-text-main flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Media Blocks
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">Add PDF, images, videos, or YouTube embeds. Drag to reorder.</p>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" onclick="addMediaBlock('pdf')" class="flex items-center gap-1 px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"></path><path fill="white" d="M14 2v6h6"></path></svg>
                                PDF
                            </button>
                            <button type="button" onclick="addMediaBlock('image')" class="flex items-center gap-1 px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                Image
                            </button>
                            <button type="button" onclick="addMediaBlock('video')" class="flex items-center gap-1 px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                                Video
                            </button>
                            <button type="button" onclick="addMediaBlock('youtube')" class="flex items-center gap-1 px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"></path><path fill="white" d="M9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path></svg>
                                YouTube
                            </button>
                        </div>
                    </div>

                    <div class="p-4" id="media-blocks-container">
                        <div id="media-blocks-list" class="space-y-3">
                        </div>
                        <div id="empty-media-message" class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-200 rounded-lg {{ (isset($publication) && !empty($publication->content_blocks)) ? 'hidden' : '' }}">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p>No media blocks yet</p>
                            <p class="text-sm text-gray-400">Add PDF, images, videos, or YouTube embeds above</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="font-heading text-lg font-semibold text-text-main mb-4">Cover Image</h2>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Image URL</label>
                        <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url', $publication->cover_image_url ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                    </div>
                    <div id="cover-preview" class="mt-3 {{ isset($publication->cover_image_url) && $publication->cover_image_url ? '' : 'hidden' }}">
                        <img src="{{ $publication->cover_image_url ?? '' }}" alt="Cover preview" class="w-full h-40 object-cover rounded-lg border border-gray-200" />
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="font-heading text-lg font-semibold text-text-main mb-4">Help</h2>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>PDF:</strong> Scientific papers, reports</p>
                        <p><strong>Image:</strong> Photos, infographics</p>
                        <p><strong>Video:</strong> Field recordings</p>
                        <p><strong>YouTube:</strong> Embed from YouTube</p>
                        <p class="pt-2 border-t">Use ⇧⇩ buttons to reorder blocks</p>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="media-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="closeMediaModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="font-heading text-lg font-semibold" id="media-modal-title">Edit Media Block</h3>
                    <button onclick="closeMediaModal()" class="p-2 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 space-y-4" id="media-modal-content">
                </div>
                <div class="flex justify-end gap-3 p-4 border-t bg-gray-50">
                    <button onclick="closeMediaModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
                    <button onclick="saveMediaBlock()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">Save Block</button>
                </div>
            </div>
        </div>
    </div>

    <div id="preview-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="closePreviewModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-3xl shadow-xl overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="font-heading text-lg font-semibold" id="preview-modal-title">Preview</h3>
                    <button onclick="closePreviewModal()" class="p-2 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4" id="preview-modal-content" style="max-height: 60vh; overflow-y: auto;"></div>
            </div>
        </div>
    </div>

    <script>
    let mediaBlocks = [];
    let editingBlockIndex = null;

    const MEDIA_TYPES = {
        pdf: { label: 'PDF', color: 'bg-red-50 text-red-600', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"></path></svg>' },
        image: { label: 'Photo', color: 'bg-blue-50 text-blue-600', icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>' },
        video: { label: 'Video', color: 'bg-purple-50 text-purple-600', icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>' },
        youtube: { label: 'YouTube', color: 'bg-red-100 text-red-600', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"></path></svg>' }
    };

    function initMediaBlocks() {
        try {
            const jsonEl = document.getElementById('content_blocks_json');
            const existingData = jsonEl ? jsonEl.value : '[]';
            mediaBlocks = JSON.parse(existingData) || [];
        } catch (e) {
            mediaBlocks = [];
        }
        renderMediaBlocks();
    }

    function renderMediaBlocks() {
        const container = document.getElementById('media-blocks-list');
        const emptyMsg = document.getElementById('empty-media-message');

        if (mediaBlocks.length === 0) {
            container.innerHTML = '';
            emptyMsg.classList.remove('hidden');
            return;
        }

        emptyMsg.classList.add('hidden');
        container.innerHTML = mediaBlocks.map((block, index) => {
            const type = MEDIA_TYPES[block.type] || MEDIA_TYPES.image;
            const displayUrl = block.type === 'youtube' ? (block.youtube_id || '') : (block.url || 'No URL');
            const caption = block.caption_id || block.caption_en || 'No caption';

            return `
                <div class="bg-white border rounded-lg p-4 flex items-center gap-3" data-index="${index}">
                    <div class="flex flex-col gap-1">
                        <button onclick="moveBlock(${index}, -1)" class="p-1 hover:bg-gray-100 rounded" ${index === 0 ? 'disabled' : ''}>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        </button>
                        <button onclick="moveBlock(${index}, 1)" class="p-1 hover:bg-gray-100 rounded" ${index === mediaBlocks.length - 1 ? 'disabled' : ''}>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                    <div class="${type.color} p-2 rounded-lg">
                        <span class="text-base">${type.icon}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate text-sm">${block.type === 'youtube' ? 'YouTube: ' + displayUrl : displayUrl}</p>
                        <p class="text-xs text-gray-500 truncate">${caption}</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <button onclick="previewBlock(${index})" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-gray-700" title="Preview">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                        <button onclick="editBlock(${index})" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-gray-700" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        <button onclick="deleteBlock(${index})" class="p-2 hover:bg-red-50 rounded-lg text-red-500 hover:text-red-600" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                        </button>
                    </div>
                </div>
            `;
        }).join('');

        document.getElementById('content_blocks_json').value = JSON.stringify(mediaBlocks);
    }

    function addMediaBlock(type) {
        editingBlockIndex = null;
        const block = {
            id: 'block-' + Date.now(),
            type: type,
            url: '',
            youtube_id: '',
            caption_id: '',
            caption_en: ''
        };

        showMediaModal(block);
    }

    function editBlock(index) {
        editingBlockIndex = index;
        showMediaModal(mediaBlocks[index]);
    }

    function showMediaModal(block) {
        const modal = document.getElementById('media-modal');
        const content = document.getElementById('media-modal-content');
        const title = document.getElementById('media-modal-title');
        const typeInfo = MEDIA_TYPES[block.type] || MEDIA_TYPES.image;

        title.textContent = 'Edit ' + typeInfo.label;

        let inputFields = '';

        if (block.type === 'youtube') {
            inputFields = `
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">YouTube Video URL</label>
                    <input type="url" id="block_url" value="${block.url || ''}" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            `;
        } else {
            inputFields = `
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Upload ${typeInfo.label}</label>
                    <div class="flex items-center gap-3">
                        <label class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span class="text-sm">Choose File</span>
                            <input type="file" id="block_file" accept="${getAcceptType(block.type)}" class="hidden" onchange="handleFileUpload(this, '${block.type}')" />
                        </label>
                        <span id="file_name_${block.type}" class="text-xs text-gray-400"></span>
                    </div>
                    <input type="hidden" id="block_url" value="${block.url || ''}" />
                    ${block.url ? '<p class="text-xs text-green-600">File uploaded: <a href="' + block.url + '" target="_blank" class="underline">View</a></p>' : ''}
                </div>
            `;
        }

        content.innerHTML = `
            ${inputFields}
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Caption (ID)</label>
                    <input type="text" id="block_caption_id" value="${block.caption_id || ''}" placeholder="Keterangan dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Caption (EN)</label>
                    <input type="text" id="block_caption_en" value="${block.caption_en || ''}" placeholder="English caption" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>
        `;

        modal.classList.remove('hidden');
    }

    function saveMediaBlock() {
        const url = document.getElementById('block_url')?.value || '';
        const caption_id = document.getElementById('block_caption_id')?.value || '';
        const caption_en = document.getElementById('block_caption_en')?.value || '';

        const blockData = {
            id: editingBlockIndex !== null ? mediaBlocks[editingBlockIndex].id : 'block-' + Date.now(),
            type: editingBlockIndex !== null ? mediaBlocks[editingBlockIndex].type : 'image',
            url: url,
            youtube_id: '',
            caption_id: caption_id,
            caption_en: caption_en
        };

        if (editingBlockIndex !== null) {
            mediaBlocks[editingBlockIndex] = blockData;
        } else {
            mediaBlocks.push(blockData);
        }

        closeMediaModal();
        renderMediaBlocks();
    }

    function closeMediaModal() {
        document.getElementById('media-modal').classList.add('hidden');
        editingBlockIndex = null;
    }

    function previewBlock(index) {
        const block = mediaBlocks[index];
        const modal = document.getElementById('preview-modal');
        const content = document.getElementById('preview-modal-content');
        const title = document.getElementById('preview-modal-title');

        title.textContent = block.caption_id || block.caption_en || 'Preview';

        let contentHtml = '';

        if (block.type === 'youtube' && block.url) {
            const youtubeId = extractYouTubeId(block.url);
            if (youtubeId) {
                contentHtml = `<div class="aspect-video"><iframe src="https://www.youtube.com/embed/${youtubeId}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>`;
            } else {
                contentHtml = `<p class="text-center text-gray-500">Invalid YouTube URL</p>`;
            }
        } else if (block.type === 'image' && block.url) {
            contentHtml = `<img src="${block.url}" alt="${block.caption_en || ''}" class="max-w-full mx-auto rounded-lg" />`;
        } else if (block.type === 'video' && block.url) {
            contentHtml = `<video src="${block.url}" controls class="w-full rounded-lg"></video>`;
        } else if (block.type === 'pdf' && block.url) {
            contentHtml = `<iframe src="${block.url}" class="w-full h-96"></iframe>`;
        } else {
            contentHtml = `<p class="text-center text-gray-500">No content to preview</p>`;
        }

        if (block.caption_id || block.caption_en) {
            contentHtml += `<p class="text-center text-sm text-gray-500 mt-4">${block.caption_id}</p><p class="text-center text-xs text-gray-400">${block.caption_en}</p>`;
        }

        content.innerHTML = contentHtml;
        modal.classList.remove('hidden');
    }

    function closePreviewModal() {
        document.getElementById('preview-modal').classList.add('hidden');
    }

    function deleteBlock(index) {
        if (!confirm('Delete this media block?')) return;
        mediaBlocks.splice(index, 1);
        renderMediaBlocks();
    }

    function moveBlock(index, direction) {
        const newIndex = index + direction;
        if (newIndex < 0 || newIndex >= mediaBlocks.length) return;

        const temp = mediaBlocks[index];
        mediaBlocks[index] = mediaBlocks[newIndex];
        mediaBlocks[newIndex] = temp;
        renderMediaBlocks();
    }

    document.getElementById('cover_image_url').addEventListener('change', function() {
        const preview = document.getElementById('cover-preview');
        const img = preview.querySelector('img');
        if (this.value) {
            img.src = this.value;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });

    function extractYouTubeId(url) {
        const patterns = [
            /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/,
            /youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/
        ];
        for (const pattern of patterns) {
            const match = url.match(pattern);
            if (match) return match[1];
        }
        return null;
    }

    function getAcceptType(type) {
        if (type === 'image') return 'image/*';
        if (type === 'video') return 'video/*';
        if (type === 'pdf') return 'application/pdf';
        return '*';
    }

    function handleFileUpload(input, type) {
        const file = input.files[0];
        if (!file) return;

        const maxSizes = { image: 10 * 1024 * 1024, video: 100 * 1024 * 1024, pdf: 50 * 1024 * 1024 };
        const maxSize = maxSizes[type] || 10 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('File too large. Max: ' + (maxSize / 1024 / 1024) + 'MB');
            input.value = '';
            return;
        }

        const fileNameEl = document.getElementById('file_name_' + type);
        if (fileNameEl) fileNameEl.textContent = 'Uploading...';

        const formData = new FormData();
        formData.append('file', file);
        formData.append('type', type);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('admin.upload') }}', {
            method: 'POST',
            body: formData
        }).then(res => res.json()).then(data => {
            if (data.error) {
                alert(data.error);
                if (fileNameEl) fileNameEl.textContent = '';
                return;
            }
            document.getElementById('block_url').value = data.url;
            if (fileNameEl) fileNameEl.textContent = file.name + ' ✓';
        }).catch(err => {
            alert('Upload failed');
            if (fileNameEl) fileNameEl.textContent = '';
        });
    }

    initMediaBlocks();
    </script>
@endsection