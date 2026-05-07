<?php
// Admin Team API
// GET    /admin/api/team - List team members
// POST   /admin/api/team - Create team member
// GET    /admin/api/team/:id - Get single team member
// PUT    /admin/api/team/:id - Update team member
// DELETE /admin/api/team/:id - Delete team member
// PUT    /admin/api/team/reorder - Bulk reorder (from public /api/team/reorder)

require_once __DIR__ . '/../../includes/auth.php';
$payload = Auth::requireAuth();

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Check for reorder endpoint
$last_part = $parts[count($parts) - 1] ?? '';
$is_reorder = ($last_part === 'reorder' && $method === 'PUT');

$id = null;
$is_id = false;

if (!$is_reorder) {
    $id = $parts[count($parts) - 1] ?? null;
    $is_id = $id && is_numeric($id);
}

// List team members
if ($method === 'GET' && !$is_id && !$is_reorder) {
    $members = Database::fetchAll(
        "SELECT * FROM team_members ORDER BY display_order ASC, id ASC"
    );
    apiResponse($members);
}

// Get single team member
if ($method === 'GET' && $is_id) {
    $member = Database::fetchOne(
        "SELECT * FROM team_members WHERE id = ?",
        [$id]
    );
    if (!$member) {
        apiError('Team member not found', 404);
    }
    apiResponse($member);
}

// Create team member
if ($method === 'POST' && !$is_reorder) {
    $input = json_decode(file_get_contents('php://input'), true);

    $name = trim($input['name'] ?? '');
    $title_id = $input['title_id'] ?? null;
    $title_en = $input['title_en'] ?? null;
    $bio_id = $input['bio_id'] ?? null;
    $bio_en = $input['bio_en'] ?? null;
    $photo_url = $input['photo_url'] ?? null;
    $linkedin_url = $input['linkedin_url'] ?? null;
    $display_order = intval($input['display_order'] ?? 0);

    if (empty($name)) {
        apiError('name is required');
    }

    $id = Database::generateUuid();

    Database::execute(
        "INSERT INTO team_members (id, name, title_id, title_en, bio_id, bio_en, photo_url, linkedin_url, display_order) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$id, $name, $title_id, $title_en, $bio_id, $bio_en, $photo_url, $linkedin_url, $display_order]
    );

    $member = Database::fetchOne("SELECT * FROM team_members WHERE id = ?", [$id]);
    apiResponse($member, 201);
}

// Update team member
if ($method === 'PUT' && $is_id) {
    $input = json_decode(file_get_contents('php://input'), true);

    $existing = Database::fetchOne("SELECT * FROM team_members WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Team member not found', 404);
    }

    $name = $input['name'] ?? $existing['name'];
    $title_id = $input['title_id'] ?? $existing['title_id'];
    $title_en = $input['title_en'] ?? $existing['title_en'];
    $bio_id = $input['bio_id'] ?? $existing['bio_id'];
    $bio_en = $input['bio_en'] ?? $existing['bio_en'];
    $photo_url = $input['photo_url'] ?? $existing['photo_url'];
    $linkedin_url = $input['linkedin_url'] ?? $existing['linkedin_url'];
    $display_order = isset($input['display_order']) ? intval($input['display_order']) : $existing['display_order'];

    Database::execute(
        "UPDATE team_members SET name=?, title_id=?, title_en=?, bio_id=?, bio_en=?, photo_url=?, linkedin_url=?, display_order=? WHERE id=?",
        [$name, $title_id, $title_en, $bio_id, $bio_en, $photo_url, $linkedin_url, $display_order, $id]
    );

    $member = Database::fetchOne("SELECT * FROM team_members WHERE id = ?", [$id]);
    apiResponse($member);
}

// Delete team member
if ($method === 'DELETE' && $is_id) {
    $existing = Database::fetchOne("SELECT * FROM team_members WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Team member not found', 404);
    }

    Database::execute("DELETE FROM team_members WHERE id = ?", [$id]);
    apiResponse(['message' => 'Team member deleted successfully']);
}

// Bulk update order (also handles /api/team/reorder via admin routing)
if ($method === 'PUT' && $is_reorder) {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['members']) && is_array($input['members'])) {
        foreach ($input['members'] as $index => $member) {
            Database::execute(
                "UPDATE team_members SET display_order = ? WHERE id = ?",
                [$index + 1, $member['id']]
            );
        }
    }

    $members = Database::fetchAll("SELECT * FROM team_members ORDER BY display_order ASC, id ASC");
    apiResponse($members);
}
