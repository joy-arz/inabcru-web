<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$currentPage = str_replace('.php', '', $currentPage);
$scriptName = basename($_SERVER['SCRIPT_NAME'], '.php');
checkAdminAuth();

$navItems = [
  ['href' => BASE_URL . '/admin/dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
  ['href' => BASE_URL . '/admin/publications', 'label' => 'Publications', 'icon' => 'book'],
  ['href' => BASE_URL . '/admin/articles', 'label' => 'Articles', 'icon' => 'newspaper'],
  ['href' => BASE_URL . '/admin/team', 'label' => 'Team', 'icon' => 'users'],
  ['href' => BASE_URL . '/admin/stats', 'label' => 'Impact Stats', 'icon' => 'chart'],
];

$icons = [
  'dashboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>',
  'book' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
  'newspaper' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
  'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
  'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
  'logout' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | InaBCRU</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/admin/assets/css/admin.css">
</head>
<body>
  <aside class="sidebar <?php echo isset($_COOKIE['sidebar_collapsed']) && $_COOKIE['sidebar_collapsed'] === 'true' ? 'collapsed' : ''; ?>">
    <div class="sidebar-header">
      <div class="sidebar-logo">
        <span class="logo-icon">I</span>
        <?php if (!isset($_COOKIE['sidebar_collapsed']) || $_COOKIE['sidebar_collapsed'] !== 'true'): ?>
          <div class="logo-text">
            <span class="brand">InaBCRU</span>
            <span class="subtitle">Admin Panel</span>
          </div>
        <?php endif; ?>
      </div>
      <button class="sidebar-toggle" onclick="toggleSidebar()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <nav class="sidebar-nav">
      <?php foreach ($navItems as $item): ?>
        <?php 
          $itemPage = str_replace(BASE_URL . '/admin/', '', $item['href']);
        ?>
        <a href="<?php echo $item['href']; ?>" class="nav-item <?php echo $scriptName === $itemPage ? 'active' : ''; ?>">
          <svg class="nav-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <?php echo $icons[$item['icon']]; ?>
          </svg>
          <?php if (!isset($_COOKIE['sidebar_collapsed']) || $_COOKIE['sidebar_collapsed'] !== 'true'): ?>
            <span class="nav-label"><?php echo $item['label']; ?></span>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </nav>

    <div class="sidebar-footer">
      <a href="<?php echo BASE_URL; ?>/admin/logout" class="nav-item logout">
        <svg class="nav-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <?php echo $icons['logout']; ?>
        </svg>
        <?php if (!isset($_COOKIE['sidebar_collapsed']) || $_COOKIE['sidebar_collapsed'] !== 'true'): ?>
          <span class="nav-label">Logout</span>
        <?php endif; ?>
      </a>
    </div>
  </aside>

  <main class="main-content">
    <div class="content-wrapper">
      <?php echo $content; ?>
    </div>
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('collapsed');
      document.cookie = `sidebar_collapsed=${sidebar.classList.contains('collapsed')}; path=/; max-age=31536000`;
    }
  </script>
</body>
</html>