<!DOCTYPE html>
<html lang="{{ $locale ?? 'id' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'InaBCRU')</title>
  <meta name="description" content="@yield('description', 'Indonesia Bat Conservation Research Union')">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: { DEFAULT: '#2B3984', dark: '#1e2a6b', light: '#3d4fa8' },
            secondary: '#3B82F6',
            cta: '#F97316',
            background: '#FFFFFF',
            text: '#0F1117',
            muted: '#6B7080',
            surface: { warm: '#F7F6F3' },
            border: '#E8E6E1',
            dark: '#0F1117'
          },
          fontFamily: {
            heading: ['Playfair Display', 'serif'],
            body: ['Inter', 'sans-serif']
          }
        }
      }
    }
  </script>

  <style>
    * { box-sizing: border-box; padding: 0; margin: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background-color: #FFFFFF; color: #0F1117; max-width: 100vw; overflow-x: hidden; line-height: 1.5; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; height: auto; }
    ::selection { background-color: #2B3984; color: white; }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #a1a1a1; }
    *:focus-visible { outline: 2px solid #2B3984; outline-offset: 3px; border-radius: 4px; }

    @keyframes marquee-logos {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .animate-marquee-logos { animation: marquee-logos 35s linear infinite; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.55s ease-out forwards; }
    .animation-delay-100 { animation-delay: 0.1s; }
    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-300 { animation-delay: 0.3s; }
    .animation-delay-400 { animation-delay: 0.4s; }

    .nav-link { transition: all 0.2s ease; }
    .nav-link:hover { background: rgba(43, 57, 132, 0.05); }
    .nav-link.active { color: #2B3984; background: rgba(43, 57, 132, 0.1); font-weight: 600; }
    .nav-link.home-active { color: white; }
    .nav-link.home-active:hover { background: rgba(255,255,255,0.1); }

    .lang-dropdown { position: relative; }
    .lang-dropdown-content { position: absolute; right: 0; top: 100%; margin-top: 8px; background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 1px solid #E8E6E1; min-width: 144px; z-index: 100; }
    .lang-dropdown-item { display: block; width: 100%; padding: 10px 16px; text-align: left; font-size: 14px; transition: background 0.2s; cursor: pointer; }
    .lang-dropdown-item:hover { background: #F7F6F3; }
    .lang-dropdown-item.active { color: #2B3984; font-weight: 500; }
  </style>
</head>
<body>
  @include('layouts.navbar', ['locale' => $locale ?? 'id'])

  <main class="flex-1">
    @yield('content')
  </main>

  @include('layouts.footer', ['locale' => $locale ?? 'id'])

  @stack('scripts')
</body>
</html>