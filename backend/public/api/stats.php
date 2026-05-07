<?php
// GET /api/stats - List all impact stats

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stats = Database::fetchAll(
        "SELECT id, label_id, label_en, value, unit, display_order 
         FROM impact_stats 
         ORDER BY display_order ASC, id ASC"
    );
    // Transform to match frontend format
    $transformed = array_map(function($s) {
        return [
            'id' => $s['id'],
            'key' => $s['label_id'],
            'value' => intval($s['value']),
            'suffix' => $s['unit'] ?? ''
        ];
    }, $stats);
    apiResponse($transformed);
}
