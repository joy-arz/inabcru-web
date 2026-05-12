@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Partners</h1>
            <p class="text-gray-500 mt-1">Manage partner logos and information</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Partner
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($partners->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-16 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <p class="text-gray-500">No partners yet</p>
            <a href="{{ route('admin.partners.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first partner</a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Alt Text</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Website</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($partners as $partner)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $partner->display_order }}</td>
                        <td class="px-6 py-4">
                            @if($partner->logo_url)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->alt_text }}" class="h-12 w-auto object-contain">
                            @else
                                <div class="h-12 w-12 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $partner->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $partner->alt_text ?: '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" class="text-primary hover:underline">{{ Str::limit($partner->website_url, 20) }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer" title="Edit">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this partner?')" class="p-2 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Delete">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection