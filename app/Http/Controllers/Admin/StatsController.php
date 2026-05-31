<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatsController extends Controller
{
    public function index(): View
    {
        $stats = ImpactStat::orderBy('display_order')->get();
        return view('admin.stats', compact('stats'));
    }

    public function update(Request $request): RedirectResponse
    {
        \Log::info('Stats update called', ['all' => $request->all(), 'query' => $request->query()]);

        $data = $request->validate([
            'stats' => 'required|array',
            'stats.*.id' => 'required|integer',
            'stats.*.label_id' => 'required|string',
            'stats.*.label_en' => 'required|string',
            'stats.*.value' => 'required|string',
            'stats.*.icon' => 'nullable|string',
        ]);

        \Log::info('Stats validated', $data);

        foreach ($data['stats'] as $statData) {
            $stat = ImpactStat::find($statData['id']);
            \Log::info('Updating stat', ['id' => $statData['id'], 'found' => $stat ? 'yes' : 'no', 'label_id' => $statData['label_id']]);
            if ($stat) {
                $stat->update([
                    'label_id' => $statData['label_id'],
                    'label_en' => $statData['label_en'],
                    'value' => $statData['value'],
                    'icon' => $statData['icon'] ?? null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Stats updated');
    }
}