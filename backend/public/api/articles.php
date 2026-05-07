<?php
// GET /api/news or /api/articles - List all articles
// GET /api/news/slug/:slug or /api/articles/slug/:slug - Get article by slug

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Remove 'api' from parts
$parts = array_slice($parts, 1);

// Check if requesting by slug: /news/slug/:slug or /articles/slug/:slug
if (count($parts) >= 3 && $parts[1] === 'slug') {
    $slug = $parts[2];
    $article = Database::fetchOne(
        "SELECT * FROM articles WHERE slug = ?",
        [$slug]
    );
    if (!$article) {
        apiError('Article not found', 404);
    }
    // Transform to match frontend format
    apiResponse([
        'id' => $article['id'],
        'slug' => $article['slug'],
        'title' => $article['title_id'],
        'titleEn' => $article['title_en'],
        'content' => $article['blocks_id'],
        'contentEn' => $article['blocks_en'],
        'coverImage' => $article['cover_image_url'],
        'metaLocation' => $article['meta_location_id'],
        'metaLocationEn' => $article['meta_location_en'],
        'date' => $article['published_at'] ?? $article['created_at'],
        'author' => null
    ]);
}
// Check if requesting by ID: /news/:id or /articles/:id
elseif (count($parts) >= 2 && is_numeric($parts[1])) {
    $id = $parts[1];
    $article = Database::fetchOne(
        "SELECT * FROM articles WHERE id = ?",
        [$id]
    );
    if (!$article) {
        apiError('Article not found', 404);
    }
    apiResponse([
        'id' => $article['id'],
        'slug' => $article['slug'],
        'title' => $article['title_id'],
        'titleEn' => $article['title_en'],
        'content' => $article['blocks_id'],
        'contentEn' => $article['blocks_en'],
        'coverImage' => $article['cover_image_url'],
        'metaLocation' => $article['meta_location_id'],
        'metaLocationEn' => $article['meta_location_en'],
        'date' => $article['published_at'] ?? $article['created_at']
    ]);
}
// List all articles
else {
    $articles = Database::fetchAll(
        "SELECT id, title_id, title_en, slug, cover_image_url, meta_location_id, meta_location_en, published_at, created_at 
         FROM articles 
         ORDER BY created_at DESC"
    );
    // Transform to match frontend format
    $transformed = array_map(function($a) {
        return [
            'id' => $a['id'],
            'slug' => $a['slug'],
            'title' => $a['title_id'],
            'titleEn' => $a['title_en'],
            'coverImage' => $a['cover_image_url'],
            'metaLocation' => $a['meta_location_id'],
            'metaLocationEn' => $a['meta_location_en'],
            'date' => $a['published_at'] ?? $a['created_at']
        ];
    }, $articles);
    apiResponse($transformed);
}
