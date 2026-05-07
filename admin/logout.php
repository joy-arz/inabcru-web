<?php
require_once __DIR__ . '/../includes/config.php';

setcookie('auth_token', '', time() - 3600, '/');
header('Location: ' . BASE_URL . '/admin/login');
exit;