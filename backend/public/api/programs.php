<?php
// GET /api/programs - List programs (hardcoded for now)

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Programs are hardcoded since they rarely change
    // If you need dynamic programs, add a programs table to the database
    $programs = [
        [
            'id' => '1',
            'title' => 'Survei Kelelawar',
            'titleEn' => 'Bat Survey',
            'description' => 'Riset lapangan untuk mengidentifikasi dan memetakan populasi kelelawar di berbagai habitat.',
            'descriptionEn' => 'Field research to identify and map bat populations across various habitats.',
            'icon' => 'search'
        ],
        [
            'id' => '2',
            'title' => 'Edukasi & Pelatihan',
            'titleEn' => 'Education & Training',
            'description' => 'Program edukasi untuk meningkatkan kesadaran tentang pentingnya kelelawar.',
            'descriptionEn' => 'Educational programs to raise awareness about the importance of bats.',
            'icon' => 'book'
        ],
        [
            'id' => '3',
            'title' => 'Konservasi Habitat',
            'titleEn' => 'Habitat Conservation',
            'description' => 'Upaya perlindungan habitat alami kelelawar untuk menjaga keseimbangan ekosistem.',
            'descriptionEn' => 'Efforts to protect natural bat habitats to maintain ecosystem balance.',
            'icon' => 'tree'
        ],
        [
            'id' => '4',
            'title' => 'Penelitian & Publikasi',
            'titleEn' => 'Research & Publications',
            'description' => 'Penelitian ilmiah dan publikasi hasil temuan tentang kelelawar.',
            'descriptionEn' => 'Scientific research and publication of findings about bats.',
            'icon' => 'academic'
        ]
    ];
    apiResponse($programs);
}
