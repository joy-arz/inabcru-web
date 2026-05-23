@extends('layouts.admin')

@push('styles')
<style>
.upload-area { border: 2px dashed #d1d5db; border-radius: 8px; transition: all 0.2s; }
.upload-area:hover { border-color: #2B3984; background: #f9fafb; }
.progress-bar { height: 4px; background: #e5e7eb; border-radius: 2px; overflow: hidden; }
.progress-bar-fill { height: 100%; background: #2B3984; transition: width 0.3s; }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'Add' }} Program</h1>
            <p class="text-gray-500 text-sm mt-1">{{ isset($id) ? 'Update program details' : 'Add a new program' }}</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 text-sm">
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

    <form method="POST" action="{{ isset($id) ? route('admin.programs.update', $id) : route('admin.programs.store') }}">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active', $program->active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Show on website</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Division</label>
                    <select name="division_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required>
                        <option value="">Select division</option>
                        @foreach($divisions as $div)
                            <option value="{{ $div->id }}" {{ old('division_id', $program->division_id ?? '') == $div->id ? 'selected' : '' }}>{{ $div->name_id }} / {{ $div->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Icon (FontAwesome class, e.g., fas fa-search)</label>
                    <input type="text" name="icon" value="{{ old('icon', $program->icon ?? '') }}" placeholder="fas fa-search" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Title (Indonesia)</label>
                    <input type="text" name="title_id" value="{{ old('title_id', $program->title_id ?? '') }}" placeholder="Survei Populasi Kelelawar" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Title (English)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $program->title_en ?? '') }}" placeholder="Bat Population Survey" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Short Description (ID)</label>
                    <textarea name="short_description_id" rows="2" placeholder="Brief description for card preview" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('short_description_id', $program->short_description_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Short Description (EN)</label>
                    <textarea name="short_description_en" rows="2" placeholder="Brief description for card preview" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('short_description_en', $program->short_description_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Full Description (ID)</label>
                    <textarea name="description_id" rows="5" placeholder="Detailed description for popup" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('description_id', $program->description_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Full Description (EN)</label>
                    <textarea name="description_en" rows="5" placeholder="Detailed description for popup" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('description_en', $program->description_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Featured Image</label>
                <input type="hidden" name="featured_image_url" id="featured_image_url" value="{{ old('featured_image_url', $program->featured_image_url ?? '') }}">
                <div id="featured-upload-area" class="upload-area p-6 text-center cursor-pointer">
                    <div id="featured-placeholder">
                        @if(isset($program->featured_image_url) && $program->featured_image_url)
                            <img src="{{ $program->featured_image_url }}" class="max-h-40 mx-auto rounded-lg">
                        @else
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500">Click or drag to upload</p>
                        @endif
                    </div>
                </div>
                <input type="file" id="featured-file-input" accept="image/*" class="hidden" onchange="handleImageUpload(this, 'featured')">
                <p class="text-xs text-gray-400">Recommended size: 1200x600px</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Carousel Images (comma-separated URLs)</label>
                <textarea name="carousel_images" rows="2" placeholder="https://example.com/img1.jpg, https://example.com/img2.jpg" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('carousel_images', is_array($program->carousel_images ?? null) ? implode(', ', $program->carousel_images) : '') }}</textarea>
                <p class="text-xs text-gray-400">Enter image URLs separated by commas</p>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.programs.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90">
                {{ isset($id) ? 'Update' : 'Add' }} Program
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('featured-upload-area').addEventListener('click', function() {
    if (!document.getElementById('featured_file_input') || !document.getElementById('featured_file_input').files[0]) {
        document.getElementById('featured-file-input').click();
    }
});

document.getElementById('featured-file-input').addEventListener('change', function() {
    if (this.files[0]) {
        uploadFile(this.files[0], 'image', 'featured');
    }
});

function handleImageUpload(input, prefix) {
    if (input.files[0]) {
        uploadFile(input.files[0], 'image', prefix);
    }
}

function uploadFile(file, type, prefix) {
    if (file.size > 10 * 1024 * 1024) {
        alert('File too large. Max 10MB');
        return;
    }

    var formData = new FormData();
    formData.append('file', file);
    formData.append('type', type);
    formData.append('_token', '{{ csrf_token() }}');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('admin.upload') }}', true);

    xhr.addEventListener('load', function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.error) {
                alert(data.error);
            } else {
                document.getElementById(prefix + '_image_url').value = data.url;
                var placeholder = document.getElementById(prefix + '-placeholder');
                placeholder.innerHTML = '<img src="' + data.url + '" class="max-h-40 mx-auto rounded-lg">';
            }
        } else {
            alert('Upload failed');
        }
    });

    xhr.addEventListener('error', function() {
        alert('Upload failed');
    });

    xhr.send(formData);
}
</script>
@endpush
@endsection