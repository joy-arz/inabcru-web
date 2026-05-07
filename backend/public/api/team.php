<?php
// GET /api/team - List all team members

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $members = Database::fetchAll(
        "SELECT id, name, title_id, title_en, photo_url, bio_id, bio_en, linkedin_url, display_order 
         FROM team_members 
         ORDER BY display_order ASC, id ASC"
    );
    // Transform to match frontend format
    $transformed = array_map(function($m) {
        return [
            'id' => $m['id'],
            'name' => $m['name'],
            'role' => $m['title_id'],
            'roleEn' => $m['title_en'],
            'bio' => $m['bio_id'],
            'bioEn' => $m['bio_en'],
            'photo' => $m['photo_url']
        ];
    }, $members);
    apiResponse($transformed);
}
