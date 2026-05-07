<?php
// GET /api/publications - List all publications
// GET /api/publications/:id - Get single publication

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $parts = explode('/', $path);
    $id = $parts[count($parts) - 1] ?? null;

    if ($id && is_numeric($id)) {
        // Get single publication
        $pub = Database::fetchOne(
            "SELECT * FROM publications WHERE id = ?",
            [$id]
        );
        if (!$pub) {
            apiError('Publication not found', 404);
        }
        // Transform to match frontend format
        apiResponse([
            'id' => $pub['id'],
            'title' => $pub['title_id'],
            'titleEn' => $pub['title_en'],
            'journal' => $pub['journal'],
            'year' => intval($pub['year']),
            'date' => $pub['created_at'],
            'coverImage' => $pub['cover_image_url'],
            'doi' => $pub['doi'],
            'contentBlocks' => json_decode($pub['content_blocks'] ?? '[]', true)
        ]);
    } else {
        // List all publications
        $publications = Database::fetchAll(
            "SELECT * FROM publications ORDER BY year DESC, created_at DESC"
        );
        $transformed = array_map(function($p) {
            return [
                'id' => $p['id'],
                'title' => $p['title_id'],
                'titleEn' => $p['title_en'],
                'journal' => $p['journal'],
                'year' => intval($p['year']),
                'date' => $p['created_at'],
                'coverImage' => $p['cover_image_url'],
                'doi' => $p['doi'],
                'contentBlocks' => json_decode($p['content_blocks'] ?? '[]', true)
            ];
        }, $publications);
        apiResponse($transformed);
    }
}
