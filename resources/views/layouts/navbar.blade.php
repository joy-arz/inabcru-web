<nav id="navbar" class="fixed top-0 left-0 right-0 z-40 transition-all duration-300 shadow-lg shadow-black/5" style="background: rgba(15, 23, 31, 0.8); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-bottom: 1px solid rgba(255,255,255,0.1);">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 md:h-20">
      <a href="/{{ $locale }}" class="flex items-center gap-3 cursor-pointer">
        <img id="navbar-logo"
          src="/images/Logo/InaBCRU_LOGO CERAH HORIZONTAL.webp"
          alt="InaBCRU"
          class="h-10 md:h-12 w-auto transition-opacity duration-300 mt-[7px]"
          style="object-fit: contain; object-position: left center;">
      </a>

      <div class="hidden xl:flex items-center gap-1">
        @php
        $navItems = [
          ['href' => "/{$locale}", 'label' => trans_for('nav.home', $locale), 'key' => 'home'],
          ['href' => "/{$locale}/about-us", 'label' => trans_for('nav.about', $locale), 'key' => 'about-us'],
          ['href' => "/{$locale}/programs", 'label' => trans_for('nav.programs', $locale), 'key' => 'programs'],
          ['href' => "/{$locale}/news", 'label' => trans_for('nav.news', $locale), 'key' => 'news'],
          ['href' => "/{$locale}/publications", 'label' => trans_for('nav.archive', $locale), 'key' => 'publications'],
          ['href' => "/{$locale}/mitra", 'label' => trans_for('nav.partners', $locale), 'key' => 'mitra'],
          ['href' => "/{$locale}/contact", 'label' => trans_for('nav.contact', $locale), 'key' => 'contact'],
        ];

        $currentPath = request()->path();
        $isHomePage = preg_match('#^' . $locale . '$#', $currentPath) || $currentPath === $locale;
        @endphp

        @if($donationEnabled ?? false)
        <div class="relative" id="supportDropdown">
          <button onclick="toggleSupportDropdown()" class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-white hover:text-primary hover:bg-white/10 transition-all duration-200 whitespace-nowrap flex items-center gap-1">
            {{ $locale == 'id' ? 'Dukungan' : 'Support' }}
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="supportDropdownContent" class="hidden absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">
            <a href="/{{ $locale }}/membership" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
              {{ $locale == 'id' ? 'Keanggotaan' : 'Membership' }}
            </a>
            <a href="/{{ $locale }}/donate" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
              {{ trans_for('nav.donate', $locale) }}
            </a>
          </div>
        </div>
        @endif

        @foreach($navItems as $item)
          <a href="{{ $item['href'] }}"
             class="nav-link px-3 py-2 rounded-lg text-sm font-medium text-white hover:text-primary hover:bg-white/10 transition-all duration-200 whitespace-nowrap {{ request()->path() == $item['href'] || ($isHomePage && $item['key'] == 'home') ? 'text-orange-500 bg-orange-500/10' : '' }}">
            {{ $item['label'] }}
          </a>
        @endforeach
      </div>

      <div class="flex items-center gap-3">
        <div class="relative lang-dropdown" id="langDropdown">
          <button onclick="toggleLangDropdown()" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-white/10 transition-colors duration-200 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
            <span class="hidden lg:inline">{{ strtoupper($locale) }}</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="langDropdownContent" class="lang-dropdown-content hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">
            <a href="/id" class="lang-dropdown-item {{ $locale == 'id' ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
              <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              Indonesia
            </a>
            <a href="/en" class="lang-dropdown-item {{ $locale == 'en' ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">
              <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              English
            </a>
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
          <a href="{{ $item['href'] }}"
             class="px-4 py-3 rounded-lg text-base font-medium transition-colors duration-200 {{ request()->path() == $item['href'] ? 'text-primary bg-primary/10' : 'text-text hover:text-primary hover:bg-primary/5' }}">
            {{ $item['label'] }}
          </a>
        @endforeach
      </div>
      <div class="pt-4 border-t border-border">
        @if($donationEnabled ?? false)
        <p class="px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-400">{{ $locale == 'id' ? 'Dukungan' : 'Support' }}</p>
        <a href="/{{ $locale }}/membership" class="block px-4 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-primary/5 transition-colors">
          {{ $locale == 'id' ? 'Keanggotaan' : 'Membership' }}
        </a>
        <a href="/{{ $locale }}/donate" class="block px-4 py-3 rounded-lg text-base font-medium text-text hover:text-primary hover:bg-primary/5 transition-colors">
          {{ trans_for('nav.donate', $locale) }}
        </a>
        @endif
      </div>
    </div>
  </div>
</nav>

<script>
  let isMenuOpen = false;
  let isLangOpen = false;
  let isSupportOpen = false;
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

  function toggleSupportDropdown() {
    isSupportOpen = !isSupportOpen;
    const content = document.getElementById('supportDropdownContent');
    content.classList.toggle('hidden', !isSupportOpen);
  }

  function handleScroll() {
    const navbar = document.getElementById('navbar');
    const navbarLogo = document.getElementById('navbar-logo');
    const navLinks = document.querySelectorAll('.nav-link');

    isScrolled = window.scrollY > 20;

    if (isScrolled) {
      navbar.style.background = 'rgba(255,255,255,0.95)';
      navbar.style.backdropFilter = 'blur(12px)';
      navbar.style.borderBottom = '1px solid #E8E6E1';
      navbar.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
      if (navbarLogo) {
        navbarLogo.src = '/images/Logo/InaBCRU_LOGO CERAH HORIZONTAL.webp';
        navbarLogo.alt = 'InaBCRU';
      }
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
      if (navbarLogo) {
        navbarLogo.src = '/images/Logo/InaBCRU_LOGO GELAP B HORIZONTAL.webp';
        navbarLogo.alt = 'InaBCRU';
      }
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
    const supportDropdown = document.getElementById('supportDropdown');
    if (!supportDropdown.contains(e.target) && isSupportOpen) {
      isSupportOpen = false;
      document.getElementById('supportDropdownContent').classList.add('hidden');
    }
  });
</script>