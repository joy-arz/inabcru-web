@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-heading text-2xl font-bold text-gray-900">{{ isset($id) ? 'Edit' : 'Add' }} Division</h1>
            <p class="text-gray-500 text-sm mt-1">{{ isset($id) ? 'Update division details' : 'Add a new division' }}</p>
        </div>
        <a href="{{ route('admin.divisions.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 text-sm">
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

    <form method="POST" action="{{ isset($id) ? route('admin.divisions.update', $id) : route('admin.divisions.store') }}">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active', $division->active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Name (Indonesia)</label>
                    <input type="text" name="name_id" value="{{ old('name_id', $division->name_id ?? '') }}" placeholder="Divisi Riset" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Name (English)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $division->name_en ?? '') }}" placeholder="Research Division" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Description (Indonesia)</label>
                    <textarea name="description_id" rows="3" placeholder="Deskripsi singkat dalam Bahasa Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('description_id', $division->description_id ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Description (English)</label>
                    <textarea name="description_en" rows="3" placeholder="Brief description in English" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none">{{ old('description_en', $division->description_en ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.divisions.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90">
                {{ isset($id) ? 'Update' : 'Add' }} Division
            </button>
        </div>
    </form>
</div>
@endsection