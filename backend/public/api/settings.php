<?php
// GET /api/settings - Get site settings (hardcoded for now)

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Site settings are hardcoded
    // If you need dynamic settings, add a settings table to the database
    $settings = [
        'bankInfo' => [
            'bankName' => 'Bank Central Asia (BCA)',
            'accountNumber' => '1234567890',
            'accountName' => 'Indonesia Bat Conservation Research Union'
        ],
        'donationTiers' => [
            [
                'id' => '1',
                'amount' => 'Rp 100.000',
                'amountValue' => 100000,
                'impact' => 'Membiayai satu hari survei kelelawar',
                'impactEn' => 'Fund one day of bat survey'
            ],
            [
                'id' => '2',
                'amount' => 'Rp 500.000',
                'amountValue' => 500000,
                'impact' => 'Membiayai pelatihan satu mahasiswa',
                'impactEn' => 'Fund one student training session'
            ],
            [
                'id' => '3',
                'amount' => 'Rp 1.000.000',
                'amountValue' => 1000000,
                'impact' => 'Membiayai satu minggu operasional lapangan',
                'impactEn' => 'Fund one week of field operations'
            ],
            [
                'id' => '4',
                'amount' => 'Rp 5.000.000+',
                'amountValue' => 5000000,
                'impact' => 'Mendukung program penelitian selama sebulan',
                'impactEn' => 'Support one month of research program'
            ]
        ],
        'contactEmail' => 'info.inabcru@gmail.com',
        'contactLocation' => 'Yogyakarta, Indonesia'
    ];
    apiResponse($settings);
}
