@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.partners.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="font-heading text-3xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'New' }} Partner</h1>
                <p class="text-gray-500 mt-1">{{ isset($id) ? 'Update partner details' : 'Add a new partner' }}</p>
            </div>
        </div>
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

    <form method="POST" action="{{ isset($id) ? route('admin.partners.update', $id) : route('admin.partners.store') }}" class="space-y-6">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-md p-6 space-y-6">
            <h2 class="font-heading text-lg font-semibold text-text-main flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Partner Details
            </h2>

            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active', $partner->active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Show on website</span>
                </label>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Partner Name</label>
                <input type="text" name="name" value="{{ old('name', $partner->name ?? '') }}" placeholder="e.g., Ministry of Environment" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" placeholder="Brief description of the partner (1-3 sentences)" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all resize-none">{{ old('description', $partner->description ?? '') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Alt Text</label>
                <input type="text" name="alt_text" value="{{ old('alt_text', $partner->alt_text ?? '') }}" placeholder="Description of logo for accessibility" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Logo URL</label>
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <span class="text-sm">Upload</span>
                        <input type="file" id="logo_file" accept="image/*" class="hidden" onchange="handleImageUpload(this, 'logo_url', 'logo_preview')" />
                    </label>
                    <span class="text-xs text-gray-400">JPG, PNG, WEBP, GIF (max 5MB)</span>
                </div>
                <input type="hidden" name="logo_url" id="logo_url" value="{{ old('logo_url', $partner->logo_url ?? '') }}">
                <div id="logo_preview" class="mt-2 {{ isset($partner->logo_url) && $partner->logo_url ? '' : 'hidden' }}">
                    <img src="{{ $partner->logo_url ?? '' }}" alt="Logo preview" class="h-16 w-auto object-contain border border-gray-200 rounded-lg p-2 bg-white" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('admin.partners.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                {{ isset($id) ? 'Update' : 'Create' }} Partner
            </button>
        </div>
    </form>

    <script>
    function handleImageUpload(input, targetInputId, previewId) {
        const file = input.files[0];
        if (!file) return;
        if (file.size > 5 * 1024 * 1024) {
            alert('File too large. Max 5MB');
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
    </script>
</div>
@endsection