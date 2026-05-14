<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'BRIN', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Main_Logo_of_National_Research_and_Innovation_Agency_of_Indonesia.svg', 'website_url' => 'https://brin.go.id'],
            ['name' => 'UGM', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/9/9f/Emblem_of_Universitas_Gadjah_Mada.svg', 'website_url' => 'https://ugm.ac.id'],
            ['name' => 'ITB', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/9/95/Logo_Institut_Teknologi_Bandung.png', 'website_url' => 'https://itb.ac.id'],
            ['name' => 'IPB', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png', 'website_url' => 'https://ipb.ac.id'],
            ['name' => 'Unpad', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/8/80/Lambang_Universitas_Padjadjaran.svg', 'website_url' => 'https://unpad.ac.id'],
            ['name' => 'UNAIR', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Logo-Branding-UNAIR-biru.png/250px-Logo-Branding-UNAIR-biru.png', 'website_url' => 'https://unair.ac.id'],
            ['name' => 'UPI', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/id/0/09/Logo_Almamater_UPI.svg', 'website_url' => 'https://upi.edu'],
            ['name' => 'LIPI', 'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/Logo_LIPI_%282018%29.svg', 'website_url' => 'https://lipi.go.id'],
        ];

        foreach ($partners as $index => $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                [
                    'logo_url' => $partner['logo_url'],
                    'website_url' => $partner['website_url'] ?? null,
                    'alt_text' => $partner['name'],
                    'display_order' => $index + 1,
                ]
            );
        }
    }
}