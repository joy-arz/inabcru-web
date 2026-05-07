<?php
// Admin Upload API
// POST /admin/api/upload - Upload file (image, pdf, video)

require_once __DIR__ . '/../../includes/auth.php';
$payload = Auth::requireAuth();

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    apiError('Method not allowed', 405);
}

$file_type = $_POST['file_type'] ?? 'image';
$allowed_types = ['image', 'pdf', 'video'];

if (!in_array($file_type, $allowed_types)) {
    apiError('Invalid file type. Must be: image, pdf, or video');
}

// Validate file
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $error_messages = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds server upload limit',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds form upload limit',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'Upload stopped by extension',
    ];
    $error = $_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE;
    apiError($error_messages[$error] ?? 'Upload failed');
}

$file = $_FILES['file'];
$max_sizes = [
    'image' => 10 * 1024 * 1024,  // 10MB
    'pdf' => 50 * 1024 * 1024,    // 50MB
    'video' => 200 * 1024 * 1024, // 200MB
];
$max_size = $max_sizes[$file_type];

if ($file['size'] > $max_size) {
    apiError('File exceeds maximum size of ' . ($max_size / 1024 / 1024) . 'MB');
}

// Validate MIME type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

$allowed_mimes = [
    'image' => ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
    'pdf' => ['application/pdf'],
    'video' => ['video/mp4', 'video/webm'],
];

if (!in_array($mime_type, $allowed_mimes[$file_type])) {
    apiError('Invalid file type: ' . $mime_type);
}

// Generate unique filename
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid() . '.' . $extension;

// Create subdirectory by type
$subdir = $file_type . 's';
$upload_path = __DIR__ . '/../../../uploads/' . $subdir;

if (!file_exists($upload_path)) {
    mkdir($upload_path, 0755, true);
}

$target_path = $upload_path . '/' . $filename;

if (!move_uploaded_file($file['tmp_name'], $target_path)) {
    apiError('Failed to save file');
}

// Return URL
$url = UPLOAD_URL . '/' . $subdir . '/' . $filename;

apiResponse([
    'url' => $url,
    'filename' => $filename,
    'file_type' => $file_type
], 201);
