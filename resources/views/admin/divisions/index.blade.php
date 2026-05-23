@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Divisions</h1>
            <p class="text-gray-500 mt-1">Manage program divisions (used for Programs and Team pages)</p>
        </div>
        <a href="{{ route('admin.divisions.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Division
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($divisions->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-16 text-center">
            <p class="text-gray-500">No divisions yet</p>
            <a href="{{ route('admin.divisions.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first division</a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name (ID/EN)</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($divisions as $division)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $division->display_order }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $division->name_id }}</div>
                            <div class="text-sm text-gray-500">{{ $division->name_en }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($division->active)
                                <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-50 rounded-full">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.divisions.edit', $division->id) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer" title="Edit">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.divisions.destroy', $division->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this division? Programs in this division will also be deleted.')" class="p-2 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Delete">
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