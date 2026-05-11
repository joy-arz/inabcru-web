<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\PublicationController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('publications', PublicationController::class);
    Route::apiResource('articles', ArticleController::class)->except(['index', 'show']);
    Route::get('articles', [ArticleController::class, 'adminIndex']);
    Route::apiResource('team', TeamController::class)->except(['index', 'show']);
    Route::get('team', [TeamController::class, 'index']);
    Route::put('stats', [StatsController::class, 'update']);
});

Route::get('articles/public', [ArticleController::class, 'index']);
Route::get('articles/{id}', [ArticleController::class, 'show']);
Route::get('stats', [StatsController::class, 'index']);