<?php
// Auth routes: /api/auth/login, /api/auth/me, /api/auth/logout

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$action = $parts[count($parts) - 1] ?? '';

// POST /api/auth/login
if ($method === 'POST' && ($action === 'login' || $action === 'auth')) {
    $input = json_decode(file_get_contents('php://input'), true);

    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($email) || empty($password)) {
        apiError('Email and password are required');
    }

    // Check if input is UUID (id) or email/username
    $user = null;
    if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $email)) {
        $user = Database::fetchOne(
            "SELECT * FROM admin_users WHERE id = ?",
            [$email]
        );
    } else {
        // Try to find user by email field (which may contain username or email)
        $user = Database::fetchOne(
            "SELECT * FROM admin_users WHERE email = ?",
            [$email]
        );
    }

    if (!$user || !Auth::passwordVerify($password, $user['password_hash'])) {
        apiError('Invalid credentials', 401);
    }

    $token = Auth::createToken($user['id'], $user['email']);

    // Set httpOnly cookie with JWT token
    setcookie('auth_token', $token, [
        'expires' => time() + (86400 * 7), // 7 days
        'path' => '/',
        'httpOnly' => true,
        'secure' => false, // Set to true in production with HTTPS
        'sameSite' => 'lax'
    ]);

    apiResponse([
        'token' => $token,
        'user' => [
            'id' => $user['id'],
            'email' => $user['email']
        ]
    ]);
}

// GET /api/auth/me
if ($method === 'GET' && $action === 'me') {
    // Check cookie first, then header
    $token = $_COOKIE['auth_token'] ?? null;

    if (!$token) {
        $headers = Auth::getAuthHeader();
        if (preg_match('/^Bearer\s+(.+)$/i', $headers, $matches)) {
            $token = $matches[1];
        }
    }

    if (!$token) {
        apiError('Authorization required', 401);
    }

    $payload = Auth::verifyToken($token);

    if (!$payload) {
        apiError('Invalid or expired token', 401);
    }

    $user = Database::fetchOne(
        "SELECT id, email FROM admin_users WHERE id = ?",
        [$payload['sub']]
    );

    if (!$user) {
        apiError('User not found', 404);
    }

    apiResponse($user);
}

// POST /api/auth/logout
if ($method === 'POST' && $action === 'logout') {
    // Clear the auth cookie
    setcookie('auth_token', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httpOnly' => true
    ]);
    apiResponse(['message' => 'Logged out successfully']);
}
