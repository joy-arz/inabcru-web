<?php
// Admin Publications API
// GET    /admin/api/publications - List publications
// POST   /admin/api/publications - Create publication
// GET    /admin/api/publications/:id - Get single publication
// PUT    /admin/api/publications/:id - Update publication
// DELETE /admin/api/publications/:id - Delete publication

require_once __DIR__ . '/../../includes/auth.php';
$payload = Auth::requireAuth();

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$id = $parts[count($parts) - 1] ?? null;
$is_id = $id && is_numeric($id);

// List publications
if ($method === 'GET' && !$is_id) {
    $publications = Database::fetchAll(
        "SELECT * FROM publications ORDER BY year DESC, created_at DESC"
    );
    foreach ($publications as &$pub) {
        $pub['content_blocks'] = json_decode($pub['content_blocks'] ?? '[]', true);
    }
    apiResponse($publications);
}

// Get single publication
if ($method === 'GET' && $is_id) {
    $publication = Database::fetchOne(
        "SELECT * FROM publications WHERE id = ?",
        [$id]
    );
    if (!$publication) {
        apiError('Publication not found', 404);
    }
    $publication['content_blocks'] = json_decode($publication['content_blocks'] ?? '[]', true);
    apiResponse($publication);
}

// Create publication
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $title_id = trim($input['title_id'] ?? '');
    $title_en = trim($input['title_en'] ?? '');
    $journal = $input['journal'] ?? null;
    $year = isset($input['year']) ? intval($input['year']) : null;
    $doi = $input['doi'] ?? null;
    $abstract_id = $input['abstract_id'] ?? null;
    $abstract_en = $input['abstract_en'] ?? null;
    $content_blocks = $input['content_blocks'] ?? [];
    $cover_image_url = $input['cover_image_url'] ?? null;

    if (empty($title_id)) {
        apiError('title_id is required');
    }

    $id = Database::generateUuid();

    Database::execute(
        "INSERT INTO publications (id, title_id, title_en, journal, year, doi, abstract_id, abstract_en, content_blocks, cover_image_url) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$id, $title_id, $title_en, $journal, $year, $doi, $abstract_id, $abstract_en, json_encode($content_blocks), $cover_image_url]
    );

    $publication = Database::fetchOne("SELECT * FROM publications WHERE id = ?", [$id]);
    $publication['content_blocks'] = json_decode($publication['content_blocks'] ?? '[]', true);
    apiResponse($publication, 201);
}

// Update publication
if ($method === 'PUT' && $is_id) {
    $input = json_decode(file_get_contents('php://input'), true);

    $existing = Database::fetchOne("SELECT * FROM publications WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Publication not found', 404);
    }

    $title_id = $input['title_id'] ?? $existing['title_id'];
    $title_en = $input['title_en'] ?? $existing['title_en'];
    $journal = $input['journal'] ?? $existing['journal'];
    $year = isset($input['year']) ? intval($input['year']) : $existing['year'];
    $doi = $input['doi'] ?? $existing['doi'];
    $abstract_id = $input['abstract_id'] ?? $existing['abstract_id'];
    $abstract_en = $input['abstract_en'] ?? $existing['abstract_en'];
    $content_blocks = isset($input['content_blocks']) ? json_encode($input['content_blocks']) : $existing['content_blocks'];
    $cover_image_url = $input['cover_image_url'] ?? $existing['cover_image_url'];

    Database::execute(
        "UPDATE publications SET title_id=?, title_en=?, journal=?, year=?, doi=?, abstract_id=?, abstract_en=?, content_blocks=?, cover_image_url=? WHERE id=?",
        [$title_id, $title_en, $journal, $year, $doi, $abstract_id, $abstract_en, $content_blocks, $cover_image_url, $id]
    );

    $publication = Database::fetchOne("SELECT * FROM publications WHERE id = ?", [$id]);
    $publication['content_blocks'] = json_decode($publication['content_blocks'] ?? '[]', true);
    apiResponse($publication);
}

// Delete publication
if ($method === 'DELETE' && $is_id) {
    $existing = Database::fetchOne("SELECT * FROM publications WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Publication not found', 404);
    }

    Database::execute("DELETE FROM publications WHERE id = ?", [$id]);
    apiResponse(['message' => 'Publication deleted successfully']);
}
