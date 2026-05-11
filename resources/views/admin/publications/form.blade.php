@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'New' }} Publication</h1>
            <p class="text-gray-500 mt-1">{{ isset($id) ? 'Update the publication details' : 'Create a new research publication' }}</p>
        </div>
        <a href="{{ route('admin.publications.index') }}" class="text-gray-500 hover:text-gray-700">
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
        <form method="POST" action="{{ isset($id) ? route('admin.publications.update', $id) : route('admin.publications.store') }}" class="space-y-6">
            @csrf
            @if(isset($id))
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Title (Indonesian)
                    </label>
                    <input type="text" name="title_id" value="{{ old('title_id', $publication->title_id ?? '') }}" placeholder="Judul publikasi dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Title (English)
                    </label>
                    <input type="text" name="title_en" value="{{ old('title_en', $publication->title_en ?? '') }}" placeholder="Publication title in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Journal / Source</label>
                    <input type="text" name="journal" value="{{ old('journal', $publication->journal ?? '') }}" placeholder="Journal name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Year</label>
                    <input type="number" name="year" value="{{ old('year', $publication->year ?? '') }}" placeholder="2024" min="1900" max="2099" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">DOI</label>
                <input type="text" name="doi" value="{{ old('doi', $publication->doi ?? '') }}" placeholder="https://doi.org/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇮🇩</span> Abstract (Indonesian)
                    </label>
                    <textarea name="abstract_id" rows="4" placeholder="Abstrak dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('abstract_id', $publication->abstract_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span>🇬🇧</span> Abstract (English)
                    </label>
                    <textarea name="abstract_en" rows="4" placeholder="Abstract in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">{{ old('abstract_en', $publication->abstract_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Cover Image URL</label>
                <input type="url" name="cover_image_url" value="{{ old('cover_image_url', $publication->cover_image_url ?? '') }}" placeholder="https://..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.publications.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                    {{ isset($id) ? 'Update' : 'Create' }} Publication
                </button>
            </div>
        </form>
    </div>
</div>
@endsection