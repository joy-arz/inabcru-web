<?php
error_reporting(0);
ini_set('display_errors', 0);

$allowed_origins = [
    'https://inabcru.org',
    'https://www.inabcru.org',
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Cookie');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$autoload_path = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload_path)) {
    require_once $autoload_path;
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'inabcru');
define('DB_USER', 'inabcru');
define('DB_PASS', 'Bat._{conserve.care.505}');
define('JWT_SECRET', 'OKfYdPLije1VYhKQm/hhgFHzrzVvAZ6dfJ2zZFMB6R0=');
define('UPLOAD_DIR', __DIR__ . '/../uploads');
define('UPLOAD_URL', 'https://inabcru.org/backend/uploads');

if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}