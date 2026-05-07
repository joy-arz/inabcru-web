<?php
// Admin Stats API
// GET    /admin/api/stats - List stats
// POST   /admin/api/stats - Create stat
// GET    /admin/api/stats/:id - Get single stat
// PUT    /admin/api/stats/:id - Update stat
// DELETE /admin/api/stats/:id - Delete stat

require_once __DIR__ . '/../../includes/auth.php';
$payload = Auth::requireAuth();

$method = $_SERVER['REQUEST_METHOD'];
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$id = $parts[count($parts) - 1] ?? null;
$is_id = $id && is_numeric($id);

// List stats
if ($method === 'GET' && !$is_id) {
    $stats = Database::fetchAll(
        "SELECT * FROM impact_stats ORDER BY display_order ASC, id ASC"
    );
    apiResponse($stats);
}

// Get single stat
if ($method === 'GET' && $is_id) {
    $stat = Database::fetchOne(
        "SELECT * FROM impact_stats WHERE id = ?",
        [$id]
    );
    if (!$stat) {
        apiError('Stat not found', 404);
    }
    apiResponse($stat);
}

// Create stat
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $label_id = trim($input['label_id'] ?? '');
    $label_en = trim($input['label_en'] ?? '');
    $value = trim($input['value'] ?? '');
    $unit = $input['unit'] ?? null;
    $display_order = intval($input['display_order'] ?? 0);

    if (empty($label_id) || empty($value)) {
        apiError('label_id and value are required');
    }

    $id = Database::generateUuid();

    Database::execute(
        "INSERT INTO impact_stats (id, label_id, label_en, value, unit, display_order) 
         VALUES (?, ?, ?, ?, ?, ?)",
        [$id, $label_id, $label_en, $value, $unit, $display_order]
    );

    $stat = Database::fetchOne("SELECT * FROM impact_stats WHERE id = ?", [$id]);
    apiResponse($stat, 201);
}

// Update stat
if ($method === 'PUT' && $is_id) {
    $input = json_decode(file_get_contents('php://input'), true);

    $existing = Database::fetchOne("SELECT * FROM impact_stats WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Stat not found', 404);
    }

    $label_id = $input['label_id'] ?? $existing['label_id'];
    $label_en = $input['label_en'] ?? $existing['label_en'];
    $value = $input['value'] ?? $existing['value'];
    $unit = $input['unit'] ?? $existing['unit'];
    $display_order = isset($input['display_order']) ? intval($input['display_order']) : $existing['display_order'];

    Database::execute(
        "UPDATE impact_stats SET label_id=?, label_en=?, value=?, unit=?, display_order=? WHERE id=?",
        [$label_id, $label_en, $value, $unit, $display_order, $id]
    );

    $stat = Database::fetchOne("SELECT * FROM impact_stats WHERE id = ?", [$id]);
    apiResponse($stat);
}

// Delete stat
if ($method === 'DELETE' && $is_id) {
    $existing = Database::fetchOne("SELECT * FROM impact_stats WHERE id = ?", [$id]);
    if (!$existing) {
        apiError('Stat not found', 404);
    }

    Database::execute("DELETE FROM impact_stats WHERE id = ?", [$id]);
    apiResponse(['message' => 'Stat deleted successfully']);
}

// Bulk update
if ($method === 'PUT' && !$is_id) {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['stats']) && is_array($input['stats'])) {
        foreach ($input['stats'] as $index => $stat) {
            Database::execute(
                "UPDATE impact_stats SET label_id=?, label_en=?, value=?, unit=?, display_order=? WHERE id=?",
                [
                    $stat['label_id'] ?? '',
                    $stat['label_en'] ?? '',
                    $stat['value'] ?? '',
                    $stat['unit'] ?? null,
                    $index + 1,
                    $stat['id']
                ]
            );
        }
    }

    $stats = Database::fetchAll("SELECT * FROM impact_stats ORDER BY display_order ASC, id ASC");
    apiResponse($stats);
}
