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
</head>
<body class="font-body bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-2xl">I</span>
                </div>
                <h1 class="font-heading text-2xl font-bold text-text-main">InaBCRU Admin</h1>
                <p class="text-gray-500 mt-1">Sign in to access the admin panel</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center gap-3 text-red-700 text-sm">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <label for="username" class="flex items-center gap-2 text-sm font-medium text-gray-700">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Username
                        </label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            value="{{ old('username') }}"
                            placeholder="Enter your username"
                            required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="flex items-center gap-2 text-sm font-medium text-gray-700">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2.5 px-4 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center gap-2 cursor-pointer"
                    >
                        Sign In
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                © 2025 Indonesia Bat Conservation Research Union
            </p>
        </div>
    </div>
</body>
</html>