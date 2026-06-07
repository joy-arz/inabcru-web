@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Team Members</h1>
            <p class="text-gray-500 mt-1">Manage team member profiles and information</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Member
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @php
    $allDivisions = \App\Models\Division::orderBy('display_order')->get();
    $divisionGroups = [];
    foreach($allDivisions as $div) {
        $divisionGroups[$div->id] = ['label' => $div->name_id . ' / ' . $div->name_en, 'members' => collect()];
    }
    $divisionGroups[0] = ['label' => 'Unassigned', 'members' => collect()];

    foreach($team as $member) {
        $divId = $member->division_id ?? 0;
        if (isset($divisionGroups[$divId])) {
            $divisionGroups[$divId]['members'][] = $member;
        } else {
            $divisionGroups[0]['members'][] = $member;
        }
    }
    @endphp

    @foreach($divisionGroups as $divId => $division)
        @if(count($division['members']) > 0)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="font-semibold text-gray-800">{{ $division['label'] }}</h3>
            </div>
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Title (ID/EN)</th>
                        <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($division['members'] as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $member->display_order }}</td>
                        <td class="px-6 py-4">
                            @if($member->photo_url)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $member->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $member->role ?: '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $member->title_id }} / {{ $member->title_en }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.team.edit', $member->id) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer" title="Edit">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this team member?')" class="p-2 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Delete">
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
    @endforeach

    @if($team->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-16 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-gray-500">No team members yet</p>
            <a href="{{ route('admin.team.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first team member</a>
        </div>
    @endif
</div>
@endsection