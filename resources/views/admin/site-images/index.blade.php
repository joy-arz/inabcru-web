@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Site Images</h1>
            <p class="text-gray-500 mt-1">Manage images used throughout the website</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @php
    $categories = $grouped->keys()->sortBy(function($cat) {
        $order = ['Hero' => 1, 'About' => 2, 'Sections' => 3, 'Logo' => 4, 'Board member' => 5, 'Field activity' => 6];
        return $order[$cat] ?? 99;
    });
    @endphp

    @foreach($categories as $category)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b bg-gray-50 px-6 py-4">
                <h2 class="font-heading text-lg font-semibold text-text-main flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    {{ $category }}
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($grouped[$category] as $image)
                    <div class="border border-gray-200 rounded-lg p-4" data-item-id="{{ $image->id }}">
                        <div class="relative aspect-video mb-3 rounded-lg overflow-hidden bg-gray-50 preview-area" data-type="{{ $image->type ?? 'image' }}" data-url="{{ $image->image_url }}">
                            @if(($image->type ?? 'image') === 'video')
                            <video src="{{ $image->image_url }}" class="w-full h-full object-contain" muted></video>
                            @else
                            <img src="{{ $image->image_url }}" alt="{{ $image->alt_text ?? $image->key }}" class="w-full h-full object-contain" onerror="this.src='/images/placeholder.webp'">
                            @endif
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs font-mono text-gray-400 bg-gray-100 px-2 py-1 rounded mb-1">{{ $image->key }}</p>
                                @if($image->location)
                                    <p class="text-xs text-gray-500">{{ $image->location }}</p>
                                @endif
                                @if($image->usage)
                                    <p class="text-xs text-primary">{{ $image->usage }}</p>
                                @endif
                            </div>
                            <input type="text" value="{{ $image->alt_text ?? '' }}" placeholder="Alt text" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" onchange="updateAltText({{ $image->id }}, this.value)" />
                            <div class="flex items-center gap-2 mt-2">
                                <label class="text-xs font-medium text-gray-500">Type:</label>
                                <select onchange="updateType({{ $image->id }}, this.value)" class="text-xs border border-gray-300 rounded px-2 py-1">
                                    <option value="image" {{ $image->type == 'image' || !$image->type ? 'selected' : '' }}>Image</option>
                                    <option value="video" {{ $image->type == 'video' ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>
                            <div class="upload-section" data-type="{{ $image->type ?? 'image' }}">
                                <label class="block text-xs font-medium text-gray-700 mb-1 upload-label">{{ $image->type == 'video' ? 'Replace Video' : 'Replace Image' }}</label>
                                <div class="flex items-center gap-2">
                                    <label class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        <span class="upload-btn-text">{{ $image->type == 'video' ? 'Upload Video' : 'Upload' }}</span>
                                        <input type="file" accept="{{ ($image->type ?? 'image') === 'video' ? 'video/*' : 'image/*' }}" class="hidden" onchange="handleImageUpload(this, {{ $image->id }})" />
                                    </label>
                                </div>
                                <div class="progress-bar-container mt-2 hidden">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary h-2 rounded-full transition-all duration-300 progress-bar" style="width: 0%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 text-center progress-text">0%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
function updateType(imageId, type) {
    const item = document.querySelector(`[data-item-id="${imageId}"]`);
    const section = item.querySelector('.upload-section');
    const label = section.querySelector('.upload-label');
    const btnText = section.querySelector('.upload-btn-text');
    const fileInput = section.querySelector('input[type="file"]');
    const previewArea = item.querySelector('.preview-area');

    section.dataset.type = type;
    label.textContent = type === 'video' ? 'Replace Video' : 'Replace Image';
    btnText.textContent = type === 'video' ? 'Upload Video' : 'Upload';
    fileInput.accept = type === 'video' ? 'video/*' : 'image/*';
    previewArea.dataset.type = type;

    fetch('/admin/site-images/' + imageId, {
        method: 'POST',
        body: new URLSearchParams({
            '_method': 'PUT',
            'type': type,
            '_token': '{{ csrf_token() }}'
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(res => res.json()).then(data => {
        if (data.success) {
            location.reload();
        }
    }).catch(err => console.error('Type update failed:', err));
}

function handleImageUpload(input, imageId) {
    const file = input.files[0];
    if (!file) return;
    const item = input.closest('[data-item-id]');
    const section = item.querySelector('.upload-section');
    const type = section.dataset.type || 'image';
    const maxSize = type === 'video' ? 100 * 1024 * 1024 : 5 * 1024 * 1024;
    if (file.size > maxSize) {
        alert('File too large. Max ' + (type === 'video' ? '100MB' : '5MB'));
        input.value = '';
        return;
    }

    const progressContainer = section.querySelector('.progress-bar-container');
    const progressBar = section.querySelector('.progress-bar');
    const progressText = section.querySelector('.progress-text');
    progressContainer.classList.remove('hidden');
    progressBar.style.width = '0%';
    progressText.textContent = '0%';

    const formData = new FormData();
    formData.append('file', file);
    formData.append('type', type);
    formData.append('_token', '{{ csrf_token() }}');

    const xhr = new XMLHttpRequest();
    xhr.upload.addEventListener('progress', (e) => {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressText.textContent = percent + '%';
        }
    });

    xhr.onload = function() {
        progressContainer.classList.add('hidden');
        if (xhr.status !== 200) {
            alert('Upload failed: Server error ' + xhr.status + ' - ' + xhr.statusText);
            return;
        }
        let data;
        try { data = JSON.parse(xhr.responseText); } catch (e) { data = {}; console.error('Parse error:', xhr.responseText); }
        if (data.error) { alert('Upload error: ' + data.error); return; }
        if (!data.url) { alert('Upload failed: No URL returned'); return; }

        const formData2 = new FormData();
        formData2.append('image_url', data.url);
        formData2.append('_token', '{{ csrf_token() }}');

        fetch('/admin/site-images/' + imageId, {
            method: 'POST',
            body: new URLSearchParams({
                '_method': 'PUT',
                'image_url': data.url,
                '_token': '{{ csrf_token() }}'
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        }).then(response => {
            console.log('Update response status:', response.status);
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Update failed response:', text);
                    throw new Error('Update failed: ' + response.status);
                });
            }
            return response.json();
        }).then(data => {
            if (data.success) location.reload();
            else alert('Update failed');
        }).catch(error => {
            console.error('Error:', error);
            alert('Update failed: ' + error.message);
        });
    };

    xhr.onerror = function() {
        progressContainer.classList.add('hidden');
        alert('Upload failed: Network error');
    };

    xhr.open('POST', '{{ route('admin.upload') }}');
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.send(formData);
}

function updateAltText(imageId, altText) {
    fetch('/admin/site-images/' + imageId, {
        method: 'POST',
        body: new URLSearchParams({
            '_method': 'PUT',
            'alt_text': altText,
            '_token': '{{ csrf_token() }}'
        }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    });
}
</script>
@endsection