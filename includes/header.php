<?php
$currentPath = $_SERVER['REQUEST_URI'];
$currentPath = str_replace(BASE_URL, '', $currentPath);
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
    <a href="<?php echo BASE_URL; ?>/" class="logo">
      <span class="logo-icon">I</span>
      <span class="logo-text">InaBCRU</span>
    </a>

    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <div class="nav-links" id="navLinks">
      <?php 
      $navItems = [
        ['href' => BASE_URL . '/', 'label' => 'Beranda'],
        ['href' => BASE_URL . '/about', 'label' => 'Tentang'],
        ['href' => BASE_URL . '/team', 'label' => 'Tim'],
        ['href' => BASE_URL . '/publications', 'label' => 'Publikasi'],
        ['href' => BASE_URL . '/donate', 'label' => 'Donasi'],
      ];
      foreach ($navItems as $item): 
        $itemPath = trim(str_replace(BASE_URL, '', $item['href']), '/');
        $isActive = ($currentPath === $itemPath) || 
                    ($currentPath === '' && $itemPath === '');
      ?>
        <a href="<?php echo $item['href']; ?>" 
           class="nav-link <?php echo $isActive ? 'active' : ''; ?>">
          <?php echo $item['label']; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </nav>
</header>

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
  height: 72px;
}

.logo {
  display: flex;
  align-items: center;
  gap: 12px;
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
}

.logo-text {
  font-family: 'Playfair Display', serif;
  font-weight: 600;
  font-size: 20px;
  color: var(--color-text);
}

.header.home .logo-text {
  color: white;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 8px;
}

.nav-link {
  padding: 8px 16px;
  font-size: 15px;
  font-weight: 500;
  color: var(--color-text);
  border-radius: 8px;
  transition: all 0.2s ease;
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

.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  padding: 8px;
  cursor: pointer;
  color: var(--color-text);
}

.header.home .mobile-menu-btn {
  color: white;
}

@media (max-width: 768px) {
  .mobile-menu-btn {
    display: block;
  }

  .nav-links {
    display: none;
    position: absolute;
    top: 72px;
    left: 0;
    right: 0;
    background: white;
    flex-direction: column;
    padding: 16px;
    border-bottom: 1px solid var(--color-border);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
  }

  .nav-links.open {
    display: flex;
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
}
</style>

<script>
window.addEventListener('scroll', function() {
  const header = document.getElementById('mainHeader');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

function toggleMobileMenu() {
  const navLinks = document.getElementById('navLinks');
  navLinks.classList.toggle('open');
}
</script>