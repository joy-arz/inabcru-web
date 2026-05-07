<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/auth.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove base path if any
$base_path = '/api';
if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

// Check for admin routes
$is_admin = strpos($request_uri, '/admin') === 0;
if ($is_admin) {
    $request_uri = substr($request_uri, 6); // Remove /admin prefix
}

// Route matching
$path = trim($request_uri, '/');
$parts = explode('/', $path);
$resource = $parts[0] ?? '';

// Public routes
if ($resource === 'publications') {
    require_once __DIR__ . '/api/publications.php';
} elseif ($resource === 'news' || $resource === 'articles') {
    // Both /news and /articles route to articles.php
    require_once __DIR__ . '/api/articles.php';
} elseif ($resource === 'team') {
    // Check if this is admin reorder
    if ($is_admin && count($parts) >= 2 && $parts[1] === 'reorder') {
        require_once __DIR__ . '/api/admin/team.php';
    } else {
        require_once __DIR__ . '/api/team.php';
    }
} elseif ($resource === 'stats') {
    require_once __DIR__ . '/api/stats.php';
} elseif ($resource === 'contact') {
    require_once __DIR__ . '/api/contact.php';
} elseif ($resource === 'programs') {
    require_once __DIR__ . '/api/programs.php';
} elseif ($resource === 'settings') {
    require_once __DIR__ . '/api/settings.php';
}
// Auth routes (public)
elseif ($resource === 'auth') {
    require_once __DIR__ . '/api/auth.php';
}
// Admin API routes
elseif ($is_admin && $resource === 'articles') {
    require_once __DIR__ . '/api/admin/articles.php';
} elseif ($is_admin && $resource === 'team') {
    require_once __DIR__ . '/api/admin/team.php';
} elseif ($is_admin && $resource === 'stats') {
    require_once __DIR__ . '/api/admin/stats.php';
} elseif ($is_admin && $resource === 'publications') {
    require_once __DIR__ . '/api/admin/publications.php';
} elseif ($is_admin && $resource === 'upload') {
    require_once __DIR__ . '/api/admin/upload.php';
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found: ' . $resource]);
}
