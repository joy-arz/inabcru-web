<?php
// POST /api/contact - Submit contact form

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $name = trim($input['name'] ?? '');
    $email = trim($input['email'] ?? '');
    $message = trim($input['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        apiError('Name, email, and message are required');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        apiError('Invalid email format');
    }

    $id = Database::generateUuid();
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';

    Database::execute(
        "INSERT INTO contact_submissions (id, name, email, message, ip_address) VALUES (?, ?, ?, ?, ?)",
        [$id, $name, $email, $message, $ip]
    );

    apiResponse(['id' => $id, 'message' => 'Contact form submitted successfully'], 201);
}
