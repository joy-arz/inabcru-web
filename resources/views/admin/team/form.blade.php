@extends('layouts.admin')

@push('styles')
<style>
.upload-area { border: 2px dashed #d1d5db; border-radius: 8px; transition: all 0.2s; }
.upload-area:hover { border-color: #2B3984; background: #f9fafb; }
.upload-area.dragover { border-color: #2B3984; background: #eef2ff; }
.progress-bar { height: 4px; background: #e5e7eb; border-radius: 2px; overflow: hidden; }
.progress-bar-fill { height: 100%; background: #2B3984; transition: width 0.3s; }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'Add' }} Team Member</h1>
            <p class="text-gray-500 text-sm mt-1">{{ isset($id) ? 'Update team member details' : 'Add a new team member' }}</p>
        </div>
        <a href="{{ route('admin.team.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 text-sm">
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

    <form method="POST" action="{{ isset($id) ? route('admin.team.update', $id) : route('admin.team.store') }}">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" placeholder="Dr. John Doe" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Division</label>
                    <select name="division_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                        <option value="">Select division</option>
                        @foreach($divisions ?? [] as $div)
                        <option value="{{ $div->id }}" {{ (old('division_id', $member->division_id ?? '') == $div->id) ? 'selected' : '' }}>{{ $div->name_id }} / {{ $div->name_en }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Role/Title (e.g., Chief of Research)</label>
                    <input type="text" name="role" value="{{ old('role', $member->role ?? '') }}" placeholder="Chief of Research" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Position (ID)</label>
                    <input type="text" name="title_id" value="{{ old('title_id', $member->title_id ?? '') }}" placeholder="Nama jabatan dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Position (EN)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $member->title_en ?? '') }}" placeholder="Position title in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Bio (ID)</label>
                    <textarea name="bio_id" rows="3" placeholder="Biografi dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('bio_id', $member->bio_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Bio (EN)</label>
                    <textarea name="bio_en" rows="3" placeholder="Biography in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('bio_en', $member->bio_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Photo</label>
                <input type="hidden" name="photo_url" id="photo_url" value="{{ old('photo_url', $member->photo_url ?? '') }}">
                <div id="photo-upload-area" class="upload-area p-6 text-center cursor-pointer">
                    <div id="photo-placeholder">
                        <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-500">Click or drag to upload photo</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (max 10MB)</p>
                    </div>
                    <div id="photo-uploading" class="hidden">
                        <p class="text-sm text-gray-500 mb-2">Uploading...</p>
                        <div class="progress-bar w-48 mx-auto">
                            <div id="photo-progress" class="progress-bar-fill" style="width: 0%"></div>
                        </div>
                        <p id="photo-percent" class="text-xs text-gray-400 mt-1">0%</p>
                    </div>
                    <div id="photo-preview" class="hidden">
                        <img id="photo-preview-img" src="" alt="" class="max-h-40 mx-auto rounded-lg">
                        <button type="button" onclick="removePhoto()" class="mt-2 text-sm text-red-500 hover:text-red-700">Remove</button>
                    </div>
                </div>
                <input type="file" id="photo-file-input" accept="image/*" class="hidden" onchange="handlePhotoUpload(this)">
            </div>

            <div class="space-y-3">
                <label class="text-sm font-medium text-gray-700">Photo Focal Point</label>
                <input type="hidden" name="photo_focal_x" id="photo_focal_x" value="{{ old('photo_focal_x', $member->photo_focal_x ?? 50) }}">
                <input type="hidden" name="photo_focal_y" id="photo_focal_y" value="{{ old('photo_focal_y', $member->photo_focal_y ?? 50) }}">
                <div id="focal-point-picker" class="relative w-40 h-40 mx-auto rounded-full overflow-hidden bg-gray-100 border-2 border-gray-200 cursor-move" style="display: none;">
                    <img id="focal-preview-img" src="" alt="" class="absolute w-full h-full object-cover pointer-events-none">
                    <div id="focal-crosshair" class="absolute w-6 h-6 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                        <svg viewBox="0 0 24 24" class="w-full h-full text-blue-500 drop-shadow-md">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                            <line x1="12" y1="2" x2="12" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="12" y1="18" x2="12" y2="22" stroke="currentColor" stroke-width="2"/>
                            <line x1="2" y1="12" x2="6" y2="12" stroke="currentColor" stroke-width="2"/>
                            <line x1="18" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-400 text-center">Drag the image inside the circle to set which part shows in the circular crop</p>
                <div class="flex gap-2 justify-center mt-2">
                    <button type="button" onclick="resetFocalPoint()" class="text-xs text-gray-500 hover:text-gray-700 underline">Reset to center</button>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Card Layout</label>
                <select name="photo_position" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                    <option value="top" {{ (old('photo_position', $member->photo_position ?? 'top') == 'top') ? 'selected' : '' }}>Top (Photo above text)</option>
                    <option value="center" {{ (old('photo_position', $member->photo_position ?? 'top') == 'center') ? 'selected' : '' }}>Center (Photo centered)</option>
                    <option value="bottom" {{ (old('photo_position', $member->photo_position ?? 'top') == 'bottom') ? 'selected' : '' }}>Bottom (Photo below text)</option>
                    <option value="left" {{ (old('photo_position', $member->photo_position ?? 'top') == 'left') ? 'selected' : '' }}>Left (Photo on left side)</option>
                    <option value="right" {{ (old('photo_position', $member->photo_position ?? 'top') == 'right') ? 'selected' : '' }}>Right (Photo on right side)</option>
                </select>
                <p class="text-xs text-gray-400">Choose how the photo is positioned relative to the text content</p>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.team.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90">
                {{ isset($id) ? 'Update' : 'Add' }} Member
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('photo-upload-area').addEventListener('click', function() {
    document.getElementById('photo-file-input').click();
});

document.getElementById('photo-file-input').addEventListener('change', function() {
    if (this.files[0]) {
        uploadFile(this.files[0], 'image', 'photo');
    }
});

function uploadFile(file, type, prefix) {
    if (file.size > 20 * 1024 * 1024) {
        alert('File too large. Max 20MB');
        return;
    }

    showUploadUI(prefix);

    var formData = new FormData();
    formData.append('file', file);
    formData.append('type', type);
    formData.append('_token', '{{ csrf_token() }}');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('admin.upload') }}', true);

    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            var percent = Math.round((e.loaded / e.total) * 100);
            updateProgress(prefix, percent);
        }
    });

    xhr.addEventListener('load', function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.error) {
                alert(data.error);
                resetUI(prefix);
            } else {
                document.getElementById(prefix + '_url').value = data.url;
                showPreviewUI(prefix, data.url);
                if (prefix === 'photo') {
                    showFocalPicker(data.url, 50, 50);
                }
            }
        } else {
            alert('Upload failed');
            resetUI(prefix);
        }
    });

    xhr.addEventListener('error', function() {
        alert('Upload failed');
        resetUI(prefix);
    });

    xhr.send(formData);
}

function showUploadUI(prefix) {
    document.getElementById(prefix + '-placeholder').classList.add('hidden');
    document.getElementById(prefix + '-uploading').classList.remove('hidden');
    document.getElementById(prefix + '-preview').classList.add('hidden');
}

function showPreviewUI(prefix, url) {
    document.getElementById(prefix + '-placeholder').classList.add('hidden');
    document.getElementById(prefix + '-uploading').classList.add('hidden');
    document.getElementById(prefix + '-preview').classList.remove('hidden');
    document.getElementById(prefix + '-preview-img').src = url;
}

function updateProgress(prefix, percent) {
    document.getElementById(prefix + '-progress').style.width = percent + '%';
    document.getElementById(prefix + '-percent').textContent = percent + '%';
}

function resetUI(prefix) {
    document.getElementById(prefix + '-placeholder').classList.remove('hidden');
    document.getElementById(prefix + '-uploading').classList.add('hidden');
    document.getElementById(prefix + '-preview').classList.add('hidden');
}

function removePhoto() {
    document.getElementById('photo_url').value = '';
    document.getElementById('photo-file-input').value = '';
    resetUI('photo');
}

@if(isset($member->photo_url) && $member->photo_url)
showPreviewUI('photo', '{{ $member->photo_url }}');
showFocalPicker('{{ $member->photo_url }}', {{ $member->photo_focal_x ?? 50 }}, {{ $member->photo_focal_y ?? 50 }});
@endif

var focalPicker = document.getElementById('focal-point-picker');
var focalImg = document.getElementById('focal-preview-img');
var focalCrosshair = document.getElementById('focal-crosshair');
var focalXInput = document.getElementById('photo_focal_x');
var focalYInput = document.getElementById('photo_focal_y');

var isDragging = false;
var startX, startY;

focalPicker.addEventListener('mousedown', function(e) {
    isDragging = true;
    startX = e.clientX;
    startY = e.clientY;
    e.preventDefault();
});

document.addEventListener('mousemove', function(e) {
    if (!isDragging) return;
    
    var rect = focalPicker.getBoundingClientRect();
    var deltaX = e.clientX - startX;
    var deltaY = e.clientY - startY;
    
    var currentX = parseFloat(focalImg.style.left || '0%');
    var currentY = parseFloat(focalImg.style.top || '0%');
    
    var newX = currentX + (deltaX / rect.width) * 100;
    var newY = currentY + (deltaY / rect.height) * 100;
    
    newX = Math.max(-50, Math.min(50, newX));
    newY = Math.max(-50, Math.min(50, newY));
    
    focalImg.style.left = newX + '%';
    focalImg.style.top = newY + '%';
    
    var focalX = 50 + newX;
    var focalY = 50 + newY;
    focalCrosshair.style.left = focalX + '%';
    focalCrosshair.style.top = focalY + '%';
    
    focalXInput.value = Math.round(focalX * 10) / 10;
    focalYInput.value = Math.round(focalY * 10) / 10;
    
    startX = e.clientX;
    startY = e.clientY;
});

document.addEventListener('mouseup', function() {
    isDragging = false;
});

function showFocalPicker(url, focalX, focalY) {
    var picker = document.getElementById('focal-point-picker');
    var img = document.getElementById('focal-preview-img');
    var crosshair = document.getElementById('focal-crosshair');
    
    img.src = url;
    picker.style.display = 'block';
    
    var offsetX = focalX - 50;
    var offsetY = focalY - 50;
    img.style.left = offsetX + '%';
    img.style.top = offsetY + '%';
    crosshair.style.left = focalX + '%';
    crosshair.style.top = focalY + '%';
}

function resetFocalPoint() {
    focalImg.style.left = '0%';
    focalImg.style.top = '0%';
    focalCrosshair.style.left = '50%';
    focalCrosshair.style.top = '50%';
    focalXInput.value = 50;
    focalYInput.value = 50;
}

function handlePhotoUpload(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var url = e.target.result;
            document.getElementById('photo_url').value = url;
            showPreviewUI('photo', url);
            showFocalPicker(url, 50, 50);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection