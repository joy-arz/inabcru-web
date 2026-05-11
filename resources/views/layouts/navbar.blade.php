<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 shadow-lg shadow-black/5" style="background: rgba(15, 23, 31, 0.8); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-bottom: 1px solid rgba(255,255,255,0.1);">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 md:h-20">
      <a href="/{{ $locale }}" class="flex items-center gap-3 cursor-pointer">
        <div id="logo-icon" class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors duration-300 bg-white">
          <span class="font-heading font-bold text-xl text-primary">I</span>
        </div>
        <span id="logo-text" class="font-heading font-bold text-xl hidden sm:block transition-colors duration-300 text-white">
          InaBCRU
        </span>
      </a>

      <div class="hidden xl:flex items-center gap-1">
        @php
        $navItems = [
          ['href' => "/{$locale}", 'label' => trans_for('nav.home', $locale), 'key' => 'home'],
          ['href' => "/{$locale}/about", 'label' => trans_for('nav.about', $locale), 'key' => 'about'],
          ['href' => "/{$locale}/vision-mission", 'label' => trans_for('nav.visionMission', $locale), 'key' => 'vision-mission'],
          ['href' => "/{$locale}/team", 'label' => trans_for('nav.team', $locale), 'key' => 'team'],
          ['href' => "/{$locale}/programs", 'label' => trans_for('nav.programs', $locale), 'key' => 'programs'],
          ['href' => "/{$locale}/publications", 'label' => trans_for('nav.publications', $locale), 'key' => 'publications'],
          ['href' => "/{$locale}/news", 'label' => trans_for('nav.news', $locale), 'key' => 'news'],
          ['href' => "/{$locale}/impact", 'label' => trans_for('nav.impact', $locale), 'key' => 'impact'],
          ['href' => "/{$locale}/donate", 'label' => trans_for('nav.donate', $locale), 'key' => 'donate', 'cta' => true],
          ['href' => "/{$locale}/contact", 'label' => trans_for('nav.contact', $locale), 'key' => 'contact'],
        ];

        $currentPath = request()->path();
        $isHomePage = preg_match('#^' . $locale . '$#', $currentPath) || $currentPath === $locale;
        @endphp

        @foreach($navItems as $item)
          @if(isset($item['cta']) && $item['cta'])
            <a href="{{ $item['href'] }}"
               class="px-3 py-2 rounded-lg text-sm font-medium bg-cta text-white hover:bg-cta/90 transition-all duration-200 whitespace-nowrap">
              {{ $item['label'] }}
            </a>
          @else
            <a href="{{ $item['href'] }}"
               class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-white hover:text-primary hover:bg-white/10 transition-all duration-200 whitespace-nowrap {{ request()->path() == $item['href'] || ($isHomePage && $item['key'] == 'home') ? 'text-orange-500 bg-orange-500/10' : '' }}">
              {{ $item['label'] }}
            </a>
          @endif
        @endforeach
      </div>

      <div class="flex items-center gap-3">
        <div class="relative lang-dropdown" id="langDropdown">
          <button onclick="toggleLangDropdown()" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-white hover:text-primary hover:bg-white/10 transition-colors duration-200 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
            <span class="hidden lg:inline">{{ strtoupper($locale) }}</span>
          </button>
          <div id="langDropdownContent" class="lang-dropdown-content hidden">
            <a href="/id" class="lang-dropdown-item {{ $locale == 'id' ? 'active' : '' }}">Indonesia</a>
            <a href="/en" class="lang-dropdown-item {{ $locale == 'en' ? 'active' : '' }}">English</a>
          </div>
        </div>

        <button onclick="toggleMobileMenu()" class="lg:hidden p-2.5 rounded-lg text-white hover:bg-white/10 transition-colors duration-200 cursor-pointer">
          <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div id="mobileMenu" class="lg:hidden hidden border-t border-border bg-white">
    <div class="max-w-6xl mx-auto px-6 py-4">
      <div class="flex flex-col gap-1 max-h-[60vh] overflow-y-auto pb-4">
        @foreach($navItems as $item)
          @if(!isset($item['cta']))
            <a href="{{ $item['href'] }}"
               class="px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200 {{ request()->path() == $item['href'] ? 'text-primary bg-primary/10' : 'text-text hover:text-primary hover:bg-primary/5' }}">
              {{ $item['label'] }}
            </a>
          @endif
        @endforeach
      </div>
      <div class="pt-4 border-t border-border">
        @foreach($navItems as $item)
          @if(isset($item['cta']))
            <a href="{{ $item['href'] }}"
               class="block px-4 py-3 rounded-lg text-base font-medium bg-cta text-white text-center">
              {{ $item['label'] }}
            </a>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</nav>

<script>
  let isMenuOpen = false;
  let isLangOpen = false;
  let isScrolled = false;

  function toggleMobileMenu() {
    isMenuOpen = !isMenuOpen;
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (isMenuOpen) {
      mobileMenu.classList.remove('hidden');
      menuIcon.classList.add('hidden');
      closeIcon.classList.remove('hidden');
    } else {
      mobileMenu.classList.add('hidden');
      menuIcon.classList.remove('hidden');
      closeIcon.classList.add('hidden');
    }
  }

  function toggleLangDropdown() {
    isLangOpen = !isLangOpen;
    const content = document.getElementById('langDropdownContent');
    content.classList.toggle('hidden', !isLangOpen);
  }

  function handleScroll() {
    const navbar = document.getElementById('navbar');
    const logoIcon = document.getElementById('logo-icon');
    const logoText = document.getElementById('logo-text');
    const navLinks = document.querySelectorAll('.nav-link');

    isScrolled = window.scrollY > 20;

    if (isScrolled) {
      navbar.style.background = 'rgba(255,255,255,0.95)';
      navbar.style.backdropFilter = 'blur(12px)';
      navbar.style.borderBottom = '1px solid #E8E6E1';
      navbar.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
      logoIcon.style.background = '#2B3984';
      logoIcon.querySelector('span').style.color = 'white';
      logoText.style.color = '#0F1117';

      navLinks.forEach(link => {
        link.classList.remove('text-white', 'home-active');
        link.classList.add('text-text');
        if (link.classList.contains('bg-orange-500/10')) {
          link.classList.remove('text-orange-500', 'bg-orange-500/10');
          link.classList.add('text-primary', 'bg-primary/10');
        }
      });

      document.querySelectorAll('.lang-dropdown button').forEach(btn => {
        btn.classList.remove('text-white');
        btn.classList.add('text-text');
      });

      document.querySelectorAll('.lang-dropdown-item').forEach(item => {
        item.style.color = '#0F1117';
      });
    } else {
      navbar.style.background = 'rgba(15, 23, 31, 0.8)';
      navbar.style.backdropFilter = 'blur(24px)';
      navbar.style.borderBottom = '1px solid rgba(255,255,255,0.1)';
      navbar.style.boxShadow = '0 4px 6px rgba(0,0,0,0.05)';
      logoIcon.style.background = 'white';
      logoIcon.querySelector('span').style.color = '#2B3984';
      logoText.style.color = 'white';

      navLinks.forEach(link => {
        link.classList.add('text-white', 'home-active');
        link.classList.remove('text-text');
        if (link.classList.contains('bg-primary/10')) {
          link.classList.remove('text-primary', 'bg-primary/10');
          link.classList.add('text-orange-500', 'bg-orange-500/10');
        }
      });

      document.querySelectorAll('.lang-dropdown button').forEach(btn => {
        btn.classList.add('text-white');
        btn.classList.remove('text-text');
      });
    }
  }

  window.addEventListener('scroll', handleScroll);
  handleScroll();

  document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('langDropdown');
    if (!dropdown.contains(e.target) && isLangOpen) {
      isLangOpen = false;
      document.getElementById('langDropdownContent').classList.add('hidden');
    }
  });
</script>