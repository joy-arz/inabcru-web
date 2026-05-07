<?php
$currentLocale = getLocaleFromUri($_SERVER['REQUEST_URI'] ?? '/');
$navItems = getNavItems($currentLocale);
$currentPath = str_replace('/' . $currentLocale, '', $_SERVER['REQUEST_URI'] ?? '/');
$currentPath = trim($currentPath, '/');
if (empty($currentPath)) {
    $currentPath = '';
    $isHomePage = true;
} else {
    $isHomePage = false;
}
?>
<header class="header <?php echo $isHomePage ? 'home' : ''; ?>" id="mainHeader">
  <nav class="nav container">
    <a href="<?php echo BASE_URL . '/' . $currentLocale; ?>" class="logo">
      <span class="logo-icon">I</span>
      <span class="logo-text">InaBCRU</span>
    </a>

    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu" aria-expanded="false">
      <svg class="menu-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
      <svg class="close-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div class="nav-links" id="navLinks">
      <?php 
      foreach ($navItems as $item): 
        $itemPath = trim(str_replace('/' . $currentLocale, '', $item['href']), BASE_URL);
        $itemPath = trim($itemPath, '/');
        $isActive = ($currentPath === $itemPath) || 
                    ($currentPath === '' && $itemPath === '');
      ?>
        <a href="<?php echo $item['href']; ?>" 
           class="nav-link <?php echo $isActive ? 'active' : ''; ?>">
          <?php echo $item['label']; ?>
        </a>
      <?php endforeach; ?>
    </div>

    <a href="<?php echo switchLocaleUrl($currentLocale); ?>" class="locale-switch">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A8.001 8.001 0 0116.953 8H12m4.947 8.5A8.001 8.001 0 0012 20v-1m4.953-8.5A8.001 8.001 0 0112 12v-1"/>
      </svg>
      <span><?php echo $currentLocale === 'id' ? 'EN' : 'ID'; ?></span>
    </a>
  </nav>
</header>

<style>
.locale-switch {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  font-size: 13px;
  font-weight: 600;
  color: var(--color-text);
  background: var(--color-surface-warm);
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.locale-switch:hover {
  background: var(--color-border);
  color: var(--color-primary);
}

.header.home .locale-switch {
  color: rgba(255,255,255,0.8);
  background: rgba(255,255,255,0.1);
}

.header.home .locale-switch:hover {
  background: rgba(255,255,255,0.2);
  color: white;
}

<style>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(232, 230, 225, 0.5);
  transition: all 0.3s ease;
  height: 64px;
}

@media (min-width: 1024px) {
  .header {
    height: 80px;
  }
}

.header.scrolled {
  background: rgba(255,255,255,0.9);
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.header.home {
  background: rgba(15, 17, 23, 0.8);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100%;
  max-width: 1152px;
  margin: 0 auto;
  padding: 0 24px;
}

.logo {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}

.logo-icon {
  width: 40px;
  height: 40px;
  background: var(--color-primary);
  color: white;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 18px;
  flex-shrink: 0;
  transition: background 0.3s ease;
}

.header.home .logo-icon {
  background: white;
  color: var(--color-primary);
}

.logo-text {
  font-family: 'Playfair Display', serif;
  font-weight: 600;
  font-size: 20px;
  color: var(--color-text);
  transition: color 0.3s ease;
}

.header.home .logo-text {
  color: white;
}

.header.scrolled .logo-icon {
  background: var(--color-primary);
  color: white;
}

.header.scrolled .logo-text {
  color: var(--color-text);
}

.nav-links {
  display: none;
  align-items: center;
  gap: 4px;
}

@media (min-width: 1024px) {
  .nav-links {
    display: flex;
  }
}

.nav-link {
  padding: 8px 12px;
  font-size: 15px;
  font-weight: 500;
  color: var(--color-text);
  border-radius: 8px;
  transition: all 0.2s ease;
  text-decoration: none;
}

@media (min-width: 1280px) {
  .nav-link {
    padding: 8px 16px;
  }
}

.nav-link:hover {
  background: var(--color-surface-warm);
  color: var(--color-primary);
}

.nav-link.active {
  color: var(--color-primary);
  font-weight: 600;
}

.header.home .nav-link {
  color: rgba(255,255,255,0.8);
}

.header.home .nav-link:hover {
  background: rgba(255,255,255,0.1);
  color: white;
}

.header.home .nav-link.active {
  color: white;
  font-weight: 600;
}

.header.home:not(.scrolled) .nav-link.active {
  color: rgba(249, 115, 22, 0.9);
  background: rgba(249, 115, 22, 0.1);
}

.mobile-menu-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  background: none;
  border: none;
  padding: 8px;
  cursor: pointer;
  color: var(--color-text);
  border-radius: 8px;
  transition: background 0.2s;
}

.mobile-menu-btn:hover {
  background: var(--color-surface-warm);
}

@media (min-width: 1024px) {
  .mobile-menu-btn {
    display: none;
  }
}

.header.home .mobile-menu-btn {
  color: white;
}

.header.home .mobile-menu-btn:hover {
  background: rgba(255,255,255,0.1);
}

@media (max-width: 1023px) {
  .nav-links {
    position: absolute;
    top: 64px;
    left: 0;
    right: 0;
    background: white;
    flex-direction: column;
    padding: 16px;
    border-bottom: 1px solid var(--color-border);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.3s ease, opacity 0.3s ease, padding 0.3s ease;
  }

  .nav-links.open {
    display: flex;
    max-height: 60vh;
    opacity: 1;
  }

  .nav-link {
    width: 100%;
    padding: 12px 16px;
  }

  .header.home .nav-link {
    color: var(--color-text);
  }

  .header.home .nav-link:hover {
    background: var(--color-surface-warm);
    color: var(--color-primary);
  }

  .header.home .nav-link.active {
    color: var(--color-primary);
    background: var(--color-surface-warm);
  }
}
</style>

<script>
(function() {
  const header = document.getElementById('mainHeader');
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const navLinks = document.getElementById('navLinks');
  const menuIcon = mobileMenuBtn.querySelector('.menu-icon');
  const closeIcon = mobileMenuBtn.querySelector('.close-icon');
  let isMenuOpen = false;

  window.addEventListener('scroll', function() {
    if (window.scrollY > 20) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });

  mobileMenuBtn.addEventListener('click', function() {
    isMenuOpen = !isMenuOpen;
    navLinks.classList.toggle('open', isMenuOpen);
    menuIcon.style.display = isMenuOpen ? 'none' : 'block';
    closeIcon.style.display = isMenuOpen ? 'block' : 'none';
    mobileMenuBtn.setAttribute('aria-expanded', isMenuOpen);
  });

  document.addEventListener('click', function(e) {
    if (isMenuOpen && !navLinks.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
      isMenuOpen = false;
      navLinks.classList.remove('open');
      menuIcon.style.display = 'block';
      closeIcon.style.display = 'none';
      mobileMenuBtn.setAttribute('aria-expanded', 'false');
    }
  });
})();
</script>