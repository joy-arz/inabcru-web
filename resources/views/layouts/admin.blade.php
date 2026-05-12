<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InaBCRU Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2B3984',
                        secondary: '#F97316',
                        'text-main': '#1F2937',
                    },
                    fontFamily: {
                        heading: ['Playfair Display', 'serif'],
                        body: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes slide-in { from { transform: translateX(-100%); } to { transform: translateX(0); } }
        .animate-slide-in { animation: slide-in 0.3s ease-out; }
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
        .hover-lift { transition: all 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="font-body antialiased">
    <div class="min-h-screen flex">
        <aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen bg-white border-r transition-all duration-300 w-64 flex flex-col">
            <div class="flex items-center h-16 px-4 border-b flex-shrink-0">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-lg">I</span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-heading font-semibold text-text-main text-sm">InaBCRU</p>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
                <button onclick="toggleSidebar()" class="ml-auto h-8 w-8 flex items-center justify-center hover:bg-gray-100 rounded transition-colors cursor-pointer">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 p-4 overflow-y-auto">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.publications.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.publications.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Publications</span>
                    </a>
                    <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.articles.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Articles</span>
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.team.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Team</span>
                    </a>
                    <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.partners.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Partners</span>
                    </a>
                    <a href="{{ route('admin.site-images.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.site-images.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20a2 2 0 002-2V8a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Site Images</span>
                    </a>
                    <a href="{{ route('admin.stats') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.stats') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Impact Stats</span>
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t flex-shrink-0">
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 w-full text-gray-600 hover:bg-red-50 hover:text-red-600 cursor-pointer">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="text-sm sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main id="mainContent" class="flex-1 transition-all duration-300 ml-64 bg-gray-50">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');
            const textElements = document.querySelectorAll('.sidebar-text');

            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                main.classList.remove('ml-64');
                main.classList.add('ml-20');
                textElements.forEach(el => el.classList.add('hidden'));
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                main.classList.remove('ml-20');
                main.classList.add('ml-64');
                textElements.forEach(el => el.classList.remove('hidden'));
            }
        }
    </script>
</body>
</html>