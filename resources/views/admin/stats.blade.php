@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Impact Statistics</h1>
            <p class="text-gray-500 mt-1">Update the statistics displayed on the homepage</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md p-6">
        @if($stats->isEmpty())
            <div class="text-center py-8">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <p class="text-gray-500">No stats configured yet</p>
            </div>
        @else
            <form action="{{ route('admin.stats') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    @foreach($stats as $index => $stat)
                    <div class="grid grid-cols-12 gap-4 items-end p-4 bg-gray-50 rounded-lg">
                        <div class="col-span-1 text-center font-mono text-gray-400 text-sm">#{{ $index + 1 }}</div>
                        <div class="col-span-3">
                            <label class="block text-xs text-gray-500 mb-1">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Label (ID)
                            </label>
                            <input type="text" name="stats[{{ $stat->id }}][label_id]" value="{{ $stat->label_id }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm" />
                        </div>
                        <div class="col-span-3">
                            <label class="block text-xs text-gray-500 mb-1">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Label (EN)
                            </label>
                            <input type="text" name="stats[{{ $stat->id }}][label_en]" value="{{ $stat->label_en }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm" />
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Value</label>
                            <input type="text" name="stats[{{ $stat->id }}][value]" value="{{ $stat->value }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm" />
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Icon (FontAwesome class)</label>
                            <input type="text" name="stats[{{ $stat->id }}][icon]" value="{{ $stat->icon }}" placeholder="e.g. fa-solid fa-microscope" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm font-mono" />
                            @if($stat->icon)
                            <div class="mt-2 flex items-center gap-2">
                                <span class="text-xs text-gray-500">Preview:</span>
                                <i class="{{ $stat->icon }} text-lg text-primary"></i>
                                <span class="text-xs text-gray-400 font-mono">{{ $stat->icon }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="col-span-1 text-center">
                            <input type="hidden" name="stats[{{ $stat->id }}][id]" value="{{ $stat->id }}" />
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-end pt-4">
                    <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors cursor-pointer">
                        Save Changes
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection