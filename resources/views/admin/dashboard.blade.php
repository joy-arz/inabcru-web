@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back to InaBCRU Admin Panel</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-green-600">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span>System operational</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.publications.index') }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500">Publications</p>
                    <p class="text-4xl font-bold text-gray-900 mt-1">{{ $stats['publications'] }}</p>
                    <div class="flex items-center mt-3 text-sm font-medium text-gray-400 group-hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View all
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-blue-50">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.articles.index') }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-emerald-50 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500">Articles</p>
                    <p class="text-4xl font-bold text-gray-900 mt-1">{{ $stats['articles'] }}</p>
                    <div class="flex items-center mt-3 text-sm font-medium text-gray-400 group-hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View all
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-emerald-50">
                    <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.team.index') }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-purple-50 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500">Team Members</p>
                    <p class="text-4xl font-bold text-gray-900 mt-1">{{ $stats['members'] }}</p>
                    <div class="flex items-center mt-3 text-sm font-medium text-gray-400 group-hover:text-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View all
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-purple-50">
                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-lg font-semibold text-gray-900">Recent Publications</h2>
                <a href="{{ route('admin.publications.index') }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors">View all</a>
            </div>
            <div class="space-y-4">
                @if($recentPublications->isEmpty())
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-gray-500">No publications yet</p>
                        <a href="{{ route('admin.publications.create') }}" class="text-sm font-medium text-primary hover:underline mt-2 inline-block">Create your first publication</a>
                    </div>
                @else
                    @foreach($recentPublications as $pub)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer group">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">{{ $pub->title_id }}</p>
                            <p class="text-xs text-gray-500">{{ $pub->year ?: 'No year' }}</p>
                        </div>
                        <a href="{{ route('admin.publications.edit', $pub->id) }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors opacity-0 group-hover:opacity-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-lg font-semibold text-gray-900">Recent Articles</h2>
                <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors">View all</a>
            </div>
            <div class="space-y-4">
                @if($recentArticles->isEmpty())
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <p class="text-gray-500">No articles yet</p>
                        <a href="{{ route('admin.articles.create') }}" class="text-sm font-medium text-primary hover:underline mt-2 inline-block">Create your first article</a>
                    </div>
                @else
                    @foreach($recentArticles as $article)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer group">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 truncate">{{ $article->title_id }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ $article->category }}</p>
                        </div>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors opacity-0 group-hover:opacity-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="font-heading text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.publications.create') }}" class="p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-200 text-center cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600">New Publication</p>
            </a>
            <a href="{{ route('admin.articles.create') }}" class="p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-200 text-center cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600">New Article</p>
            </a>
            <a href="{{ route('admin.team.create') }}" class="p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-200 text-center cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-100 transition-colors">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600">Add Team Member</p>
            </a>
            <a href="{{ route('admin.stats') }}" class="p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary hover:bg-primary/5 transition-all duration-200 text-center cursor-pointer group">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-100 transition-colors">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-600">Edit Stats</p>
            </a>
        </div>
    </div>
</div>
@endsection