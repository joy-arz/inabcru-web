<?php

class Auth {
    private static $secret = JWT_SECRET;

    public static function createToken($userId, $email) {
        $payload = [
            'iss' => 'inabcru-api',
            'iat' => time(),
            'exp' => time() + (86400 * 7), // 7 days
            'sub' => $userId,
            'email' => $email
        ];
        $payload_encoded = self::base64UrlEncode(json_encode($payload));
        $signature = self::base64UrlEncode(
            hash_hmac('sha256', "$payload_encoded", self::$secret, true)
        );
        return "$payload_encoded.$signature";
    }

    public static function verifyToken($token) {
        $parts = explode('.', $token);
        if (count($parts) !== 2) {
            return false;
        }

        [$payload_encoded, $signature] = $parts;
        $expected_signature = self::base64UrlEncode(
            hash_hmac('sha256', $payload_encoded, self::$secret, true)
        );

        if ($signature !== $expected_signature) {
            return false;
        }

        $payload = json_decode(self::base64UrlDecode($payload_encoded), true);
        if (!$payload || $payload['exp'] < time()) {
            return false;
        }

        return $payload;
    }

    public static function getAuthHeader() {
        $headers = [];
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }
        return $headers;
    }

    public static function requireAuth() {
        // Check cookie first, then Authorization header
        $token = $_COOKIE['auth_token'] ?? null;

        if (!$token) {
            $headers = self::getAuthHeader();
            if (preg_match('/^Bearer\s+(.+)$/i', $headers, $matches)) {
                $token = $matches[1];
            }
        }

        if (!$token) {
            http_response_code(401);
            echo json_encode(['error' => 'Authorization required']);
            exit;
        }

        $payload = self::verifyToken($token);

        if (!$payload) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid or expired token']);
            exit;
        }

        return $payload;
    }

    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function passwordHash($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public static function passwordVerify($password, $hash) {
        return password_verify($password, $hash);
    }
}

function apiResponse($data, $status = 200) {
    http_response_code($status);
    echo json_encode(['data' => $data]);
    exit;
}

function apiError($message, $status = 400) {
    http_response_code($status);
    echo json_encode(['error' => $message]);
    exit;
}
