<?php
// Admin Articles API
// GET    /admin/api/articles - List articles
// POST   /admin/api/articles - Create article
// GET    /admin/api/articles/:id - Get single article
// PUT    /admin/api/articles/:id - Update article
// DELETE /admin/api/articles/:id - Delete article

require_once __DIR__ . '/../../includes/auth.php';
$payload = Auth::requireAuth();

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$id = $parts[count($parts) - 1] ?? null;
$is_id = $id && is_numeric($id);

// List articles
if ($method === 'GET' && !$is_id) {
    $articles = Database::fetchAll(
        "SELECT * FROM articles ORDER BY created_at DESC"
    );
    foreach ($articles as &$article) {
        $article['blocks_id'] = json_decode($article['blocks_id'] ?? 'null', true);
        $article['blocks_en'] = json_decode($article['blocks_en'] ?? 'null', true);
    }
    apiResponse($articles);
}

// Get single article
if ($method === 'GET' && $is_id) {
    $article = Database::fetchOne(
        "SELECT * FROM articles WHERE id = ?",
        [$id]
    );
    if (!$article) {
        apiError('Article not found', 404);
    }
    $article['blocks_id'] = json_decode($article['blocks_id'] ?? 'null', true);
    $article['blocks_en'] = json_decode($article['blocks_en'] ?? 'null', true);
    apiResponse($article);
}

// Create article
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $title_id = trim($input['title_id'] ?? '');
    $title_en = trim($input['title_en'] ?? '');
    $slug = trim($input['slug'] ?? '');
    $blocks_id = $input['blocks_id'] ?? null;
    $blocks_en = $input['blocks_en'] ?? null;
    $cover_image_url = $input['cover_image_url'] ?? null;
    $meta_location_id = $input['meta_location_id'] ?? null;
    $meta_location_en = $input['meta_location_en'] ?? null;
    $published_at = $input['published_at'] ?? null;

    if (empty($title_id) || empty($slug)) {
        apiError('title_id and slug are required');
    }

    if (empty($slug)) {
        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($title_id));
        $slug = trim($slug, '-');
    }

    // Check slug uniqueness
    $existing = Database::fetchOne("SELECT id FROM articles WHERE slug = ?", [$slug]);
    if ($existing) {
        $slug = $slug . '-' . time();
    }

    $id = Database::generateUuid();
    // blocks_id/blocks_en are already JSON strings from Tiptap frontend
    // No need to json_encode() them - they're already valid JSON
    $blocks_id_json = is_array($blocks_id) ? json_encode($blocks_id) : $blocks_id;
    $blocks_en_json = is_array($blocks_en) ? json_encode($blocks_en) : $blocks_en;

    Database::execute(
        "INSERT INTO articles (id, title_id, title_en, slug, blocks_id, blocks_en, cover_image_url, meta_location_id, meta_location_en, published_at) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$id, $title_id, $title_en, $slug, $blocks_id_json, $blocks_en_json, $cover_image_url, $meta_location_id, $meta_location_en, $published_at]
    );

    $article = Database::fetchOne("SELECT * FROM articles WHERE id = ?", [$id]);
    $article['blocks_id'] = json_decode($article['blocks_id'] ?? 'null', true);
    $article['blocks_en'] = json_decode($article['blocks_en'] ?? 'null', true);
    apiResponse($article, 201);
}

// Update article
if ($method === 'PUT' && $is_id) {
    $input = json_decode(file_get_contents('php://input'), true);

    $existing = Database::fetchOne("SELECT * FROM articles WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Article not found', 404);
    }

    $title_id = $input['title_id'] ?? $existing['title_id'];
    $title_en = $input['title_en'] ?? $existing['title_en'];
    $slug = $input['slug'] ?? $existing['slug'];
    // blocks_id/blocks_en are already JSON strings from Tiptap frontend
    // Only json_encode if it's an array, otherwise use as-is
    $blocks_id = isset($input['blocks_id'])
        ? (is_array($input['blocks_id']) ? json_encode($input['blocks_id']) : $input['blocks_id'])
        : $existing['blocks_id'];
    $blocks_en = isset($input['blocks_en'])
        ? (is_array($input['blocks_en']) ? json_encode($input['blocks_en']) : $input['blocks_en'])
        : $existing['blocks_en'];
    $cover_image_url = $input['cover_image_url'] ?? $existing['cover_image_url'];
    $meta_location_id = $input['meta_location_id'] ?? $existing['meta_location_id'];
    $meta_location_en = $input['meta_location_en'] ?? $existing['meta_location_en'];
    $published_at = $input['published_at'] ?? $existing['published_at'];

    Database::execute(
        "UPDATE articles SET title_id=?, title_en=?, slug=?, blocks_id=?, blocks_en=?, cover_image_url=?, meta_location_id=?, meta_location_en=?, published_at=? WHERE id=?",
        [$title_id, $title_en, $slug, $blocks_id, $blocks_en, $cover_image_url, $meta_location_id, $meta_location_en, $published_at, $id]
    );

    $article = Database::fetchOne("SELECT * FROM articles WHERE id = ?", [$id]);
    $article['blocks_id'] = json_decode($article['blocks_id'] ?? 'null', true);
    $article['blocks_en'] = json_decode($article['blocks_en'] ?? 'null', true);
    apiResponse($article);
}

// Delete article
if ($method === 'DELETE' && $is_id) {
    $existing = Database::fetchOne("SELECT * FROM articles WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Article not found', 404);
    }

    Database::execute("DELETE FROM articles WHERE id = ?", [$id]);
    apiResponse(['message' => 'Article deleted successfully']);
}
