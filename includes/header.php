<?php
$requestUri = $_SERVER['REQUEST_URI'];
$currentPath = str_replace(BASE_URL, '', $requestUri);
$currentPath = trim($currentPath, '/');
if (empty($currentPath)) {
    $currentPath = '';
}
$currentPage = $currentPath ?: 'index';
?>
<header class="header">
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

    <div class="nav-links">
      <?php foreach ($navItems as $item): 
        $itemPath = trim(str_replace(BASE_URL, '', $item['href']), '/');
        $isActive = ($currentPage === $itemPath) || 
                    ($currentPage === $itemPath . '.php') ||
                    ($itemPath === '' && $currentPage === 'index');
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
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--color-border);
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

.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  padding: 8px;
  cursor: pointer;
  color: var(--color-text);
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
}
</style>

<script>
function toggleMobileMenu() {
  const navLinks = document.querySelector('.nav-links');
  navLinks.classList.toggle('open');
}
</script>