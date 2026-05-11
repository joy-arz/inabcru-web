<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImpactStat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function index(): JsonResponse
    {
        $stats = ImpactStat::orderBy('display_order')->get();
        return response()->json(['data' => $stats]);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'stats' => 'required|array',
            'stats.*.id' => 'required|integer',
            'stats.*.label_id' => 'required|string',
            'stats.*.label_en' => 'required|string',
            'stats.*.value' => 'required|string',
            'stats.*.icon' => 'nullable|string',
            'stats.*.display_order' => 'nullable|integer',
        ]);

        foreach ($data['stats'] as $statData) {
            ImpactStat::where('id', $statData['id'])->update([
                'label_id' => $statData['label_id'],
                'label_en' => $statData['label_en'],
                'value' => $statData['value'],
                'icon' => $statData['icon'] ?? null,
                'display_order' => $statData['display_order'] ?? 0,
            ]);
        }

        return response()->json(['message' => 'Stats updated', 'data' => ImpactStat::orderBy('display_order')->get()]);
    }
}