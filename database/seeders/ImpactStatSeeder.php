<?php

namespace Database\Seeders;

use App\Models\ImpactStat;
use Illuminate\Database\Seeder;

class ImpactStatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['label_id' => 'Spesies Kelelawar', 'label_en' => 'Bat Species', 'value' => '175+', 'icon' => '🦇', 'display_order' => 1],
            ['label_id' => 'Peneliti Aktif', 'label_en' => 'Active Researchers', 'value' => '45', 'icon' => '👨‍🔬', 'display_order' => 2],
            ['label_id' => 'Publikasi Ilmiah', 'label_en' => 'Scientific Publications', 'value' => '120+', 'icon' => '📚', 'display_order' => 3],
            ['label_id' => 'Lokasi Riset', 'label_en' => 'Research Sites', 'value' => '25', 'icon' => '🌍', 'display_order' => 4],
        ];

        foreach ($stats as $stat) {
            ImpactStat::updateOrCreate(
                ['label_id' => $stat['label_id']],
                $stat
            );
        }
    }
}