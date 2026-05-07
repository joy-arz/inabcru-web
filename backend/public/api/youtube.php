<?php
// GET /api/youtube - Get YouTube videos
// This endpoint returns empty array as YouTube videos are typically hardcoded

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    apiResponse([]);
}
