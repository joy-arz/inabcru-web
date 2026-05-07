<?php
require_once __DIR__ . '/config.php';

function getApi($endpoint, $useAuth = false) {
    $url = API_BASE_URL . $endpoint;
    $options = [
        'http' => [
            'method' => 'GET',
            'header' => "Content-Type: application/json\r\n",
            'ignore_errors' => true
        ]
    ];

    if ($useAuth && isset($_COOKIE['auth_token'])) {
        $options['http']['header'] .= "Authorization: Bearer " . $_COOKIE['auth_token'] . "\r\n";
    }

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    return $response ? json_decode($response, true) : null;
}

function postApi($endpoint, $data, $useAuth = false) {
    $url = API_BASE_URL . $endpoint;
    $payload = json_encode($data);
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => $payload,
            'ignore_errors' => true
        ]
    ];

    if ($useAuth && isset($_COOKIE['auth_token'])) {
        $options['http']['header'] .= "Authorization: Bearer " . $_COOKIE['auth_token'] . "\r\n";
    }

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    return $response ? json_decode($response, true) : null;
}

function putApi($endpoint, $data, $useAuth = false) {
    $url = API_BASE_URL . $endpoint;
    $payload = json_encode($data);
    $options = [
        'http' => [
            'method' => 'PUT',
            'header' => "Content-Type: application/json\r\n",
            'content' => $payload,
            'ignore_errors' => true
        ]
    ];

    if ($useAuth && isset($_COOKIE['auth_token'])) {
        $options['http']['header'] .= "Authorization: Bearer " . $_COOKIE['auth_token'] . "\r\n";
    }

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    return $response ? json_decode($response, true) : null;
}

function deleteApi($endpoint, $useAuth = false) {
    $url = API_BASE_URL . $endpoint;
    $options = [
        'http' => [
            'method' => 'DELETE',
            'header' => "Content-Type: application/json\r\n",
            'ignore_errors' => true
        ]
    ];

    if ($useAuth && isset($_COOKIE['auth_token'])) {
        $options['http']['header'] .= "Authorization: Bearer " . $_COOKIE['auth_token'] . "\r\n";
    }

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    return $response ? json_decode($response, true) : null;
}

function isAuthenticated() {
    return isset($_COOKIE['auth_token']);
}

function checkAdminAuth() {
    if (!isAuthenticated()) {
        header('Location: ' . BASE_URL . '/admin/login.php');
        exit;
    }
}

function checkLoginToken() {
    if (isset($_COOKIE['auth_token'])) {
        header('Location: ' . BASE_URL . '/admin/dashboard.php');
        exit;
    }
}