@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">{{ isset($section) ? 'Edit Section' : 'New Section' }}</h1>
            <p class="text-gray-500 mt-1">{{ isset($section) ? 'Update section details' : 'Create a new publication section' }}</p>
        </div>
        <a href="{{ route('admin.publication-sections.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
            <button class="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </button>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ isset($section) ? route('admin.publication-sections.update', $section->id) : route('admin.publication-sections.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($section))
                @method('PUT')
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title (Indonesia)</label>
                    <input type="text" name="title_id" value="{{ $section->title_id ?? old('title_id') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title (English)</label>
                    <input type="text" name="title_en" value="{{ $section->title_en ?? old('title_en') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                <input type="number" name="display_order" value="{{ $section->display_order ?? old('display_order', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" />
                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
            </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                    {{ isset($section) ? 'Update Section' : 'Create Section' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection