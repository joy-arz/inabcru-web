<?php
define('API_BASE_URL', 'https://inabcru.org/backend/api');
define('BASE_URL', 'https://inabcru.org');

define('PRIMARY_COLOR', '#2B3984');
define('CTA_COLOR', '#F97316');

function getLocaleFromPath($uri) {
    if (preg_match('/^\/(id|en)\//', $uri, $matches)) {
        return $matches[1];
    }
    return 'id';
}

function t($key, $locale = 'id') {
    static $messages = null;
    if ($messages === null) {
        $messages = [
            'id' => [
                'metadata' => [
                    'title' => 'InaBCRU - Indonesia Bat Conservation Research Union',
                    'description' => 'Perkumpulan Indonesia Bat Conservation Research Union - Membangun kredibilitas donor untuk konservasi kelelawar di Indonesia'
                ],
                'nav' => [
                    'home' => 'Beranda',
                    'about' => 'Tentang',
                    'visionMission' => 'Visi & Misi',
                    'team' => 'Tim',
                    'programs' => 'Program',
                    'publications' => 'Publikasi',
                    'news' => 'Berita',
                    'impact' => 'Dampak',
                    'donate' => 'Donasi',
                    'contact' => 'Kontak'
                ],
                'footer' => [
                    'tagline' => 'Melindungi kelelawar untuk menjaga keseimbangan ekosistem Indonesia',
                    'quickLinks' => 'Tautan Cepat',
                    'contactInfo' => 'Informasi Kontak',
                    'email' => 'Email',
                    'founded' => 'Didirikan',
                    'legalId' => 'AHU-0009178.AH.01.07.TAHUN 2025',
                    'rights' => 'Hak Cipta'
                ],
                'home' => [
                    'hero' => [
                        'title' => 'Indonesia Bat Conservation Research Union',
                        'subtitle' => 'Membangun kredibilitas institusi untuk konservasi kelelawar di Indonesia',
                        'cta' => 'Dukung Kami'
                    ],
                    'stats' => [
                        'title' => 'Dampak Kami',
                        'speciesSurveyed' => 'Jumlah spesies disurvei',
                        'researchLocations' => 'Lokasi penelitian',
                        'scientificPublications' => 'Publikasi ilmiah',
                        'activeMembers' => 'Anggota aktif',
                        'trainingActivities' => 'Kegiatan pelatihan'
                    ],
                    'mission' => [
                        'title' => 'Misi Kami',
                        'description' => 'Membangun kredibilitas donor institusi untuk organisasi non-profit konservasi kelelawar di Indonesia.'
                    ],
                    'programs' => [
                        'title' => 'Program Kami',
                        'subtitle' => 'Beragam program untuk konservasi dan penelitian kelelawar'
                    ],
                    'latestNews' => [
                        'title' => 'Berita Terbaru'
                    ],
                    'donateCta' => [
                        'title' => 'Dukung Konservasi Kelelawar',
                        'description' => 'Kelelawar melindungi hutan, pangan, dan kesehatan kita — bantu kami melindungi mereka.',
                        'button' => 'Donasi Sekarang'
                    ]
                ],
                'about' => [
                    'title' => 'Tentang InaBCRU',
                    'description' => 'InaBCRU adalah organisasi yang didedikasikan untuk konservasi kelelawar di Indonesia melalui penelitian, edukasi, dan kolaborasi dengan berbagai pihak.',
                    'founded' => 'Didirikan pada 5 Februari 2025 di Yogyakarta',
                    'legalId' => 'AHU-0009178.AH.01.07.TAHUN 2025'
                ],
                'visionMission' => [
                    'title' => 'Visi & Misi',
                    'vision' => [
                        'title' => 'Visi',
                        'description' => 'Menjadi organisasi terdepan dalam konservasi kelelawar di Indonesia dengan membangun kredibilitas dan kepercayaan donor institusi.'
                    ],
                    'mission' => [
                        'title' => 'Misi',
                        'items' => [
                            'Melakukan penelitian ilmiah tentang kelelawar di Indonesia',
                            'Membangun kemitraan dengan institusi donor dan akademik',
                            'Menyelenggarakan program edukasi dan pelatihan',
                            'Mengadvokasi kebijakan konservasi kelelawar'
                        ]
                    ]
                ],
                'team' => [
                    'title' => 'Tim Kami',
                    'subtitle' => 'Tim peneliti dan konservasionis yang berdedikasi'
                ],
                'programs' => [
                    'title' => 'Program',
                    'subtitle' => 'Program konservasi dan penelitian kami'
                ],
                'publications' => [
                    'title' => 'Publikasi',
                    'subtitle' => 'Publikasi ilmiah dan hasil penelitian kami',
                    'filterByYear' => 'Filter berdasarkan tahun',
                    'allYears' => 'Semua tahun',
                    'viewPublication' => 'Lihat Publikasi',
                    'viewJournal' => 'Lihat Jurnal',
                    'mediaTypes' => [
                        'pdf' => 'PDF',
                        'images' => 'Gambar',
                        'video' => 'Video',
                        'youtube' => 'YouTube'
                    ]
                ],
                'news' => [
                    'title' => 'Berita',
                    'subtitle' => 'Berita dan artikel terbaru',
                    'readMore' => 'Baca Selengkapnya'
                ],
                'impact' => [
                    'title' => 'Dampak Kami',
                    'subtitle' => 'Hasil kerja keras kami dalam konservasi kelelawar'
                ],
                'donate' => [
                    'title' => 'Dukung Kami',
                    'subtitle' => 'Bantu kami melindungi kelelawar Indonesia',
                    'description' => 'Kelelawar melindungi hutan, pangan, dan kesehatan kita — bantu kami melindungi mereka.',
                    'bankTransfer' => 'Transfer Bank',
                    'bankName' => 'Nama Bank',
                    'accountNumber' => 'Nomor Rekening',
                    'accountName' => 'Nama Penerima',
                    'donationTiers' => [
                        'title' => 'Paket Donasi',
                        'Rp100K' => [
                            'amount' => 'Rp 100.000',
                            'impact' => 'Mendukung biaya bahan edukasi untuk satu sekolah'
                        ],
                        'Rp500K' => [
                            'amount' => 'Rp 500.000',
                            'impact' => 'Mendukung satu sesi pelatihan lapangan'
                        ],
                        'Rp1M' => [
                            'amount' => 'Rp 1.000.000',
                            'impact' => 'Mendukung penelitian satu lokasi survei'
                        ],
                        'Rp5M' => [
                            'amount' => 'Rp 5.000.000+',
                            'impact' => 'Mendukung program konservasi terintegrasi'
                        ]
                    ],
                    'institutional' => [
                        'title' => 'Donor Institusi',
                        'mouInfo' => 'Kami menyediakan MoU untuk donor institusi dengan laporan transparansi lengkap.',
                        'contactForMoU' => 'Hubungi kami untuk informasi MoU'
                    ],
                    'ctaQuote' => 'Kelelawar melindungi hutan, pangan, dan kesehatan kita — bantu kami melindungi mereka.'
                ],
                'contact' => [
                    'title' => 'Kontak Kami',
                    'subtitle' => 'Hubungi kami untuk informasi lebih lanjut',
                    'email' => 'Email',
                    'location' => 'Lokasi',
                    'sendMessage' => 'Kirim Pesan',
                    'name' => 'Nama',
                    'message' => 'Pesan',
                    'send' => 'Kirim'
                ],
                'common' => [
                    'loading' => 'Memuat...',
                    'error' => 'Terjadi kesalahan',
                    'close' => 'Tutup',
                    'previous' => 'Sebelumnya',
                    'next' => 'Selanjutnya',
                    'download' => 'Unduh',
                    'pageOf' => 'Halaman {current} dari {total}'
                ]
            ],
            'en' => [
                'metadata' => [
                    'title' => 'InaBCRU - Indonesia Bat Conservation Research Union',
                    'description' => 'Indonesia Bat Conservation Research Union - Building institutional donor credibility for bat conservation in Indonesia'
                ],
                'nav' => [
                    'home' => 'Home',
                    'about' => 'About',
                    'visionMission' => 'Vision & Mission',
                    'team' => 'Team',
                    'programs' => 'Programs',
                    'publications' => 'Publications',
                    'news' => 'News',
                    'impact' => 'Impact',
                    'donate' => 'Donate',
                    'contact' => 'Contact'
                ],
                'footer' => [
                    'tagline' => 'Protecting bats to maintain the balance of Indonesia\'s ecosystem',
                    'quickLinks' => 'Quick Links',
                    'contactInfo' => 'Contact Information',
                    'email' => 'Email',
                    'founded' => 'Founded',
                    'legalId' => 'AHU-0009178.AH.01.07.TAHUN 2025',
                    'rights' => 'All Rights Reserved'
                ],
                'home' => [
                    'hero' => [
                        'title' => 'Indonesia Bat Conservation Research Union',
                        'subtitle' => 'Building institutional donor credibility for bat conservation NGO in Indonesia',
                        'cta' => 'Support Us'
                    ],
                    'stats' => [
                        'title' => 'Our Impact',
                        'speciesSurveyed' => 'Species surveyed',
                        'researchLocations' => 'Research locations',
                        'scientificPublications' => 'Scientific publications',
                        'activeMembers' => 'Active members',
                        'trainingActivities' => 'Training activities'
                    ],
                    'mission' => [
                        'title' => 'Our Mission',
                        'description' => 'Building institutional donor credibility for bat conservation non-profit organization in Indonesia.'
                    ],
                    'programs' => [
                        'title' => 'Our Programs',
                        'subtitle' => 'Various programs for bat conservation and research'
                    ],
                    'latestNews' => [
                        'title' => 'Latest News'
                    ],
                    'donateCta' => [
                        'title' => 'Support Bat Conservation',
                        'description' => 'Bats protect our forests, food, and health — help us protect them.',
                        'button' => 'Donate Now'
                    ]
                ],
                'about' => [
                    'title' => 'About InaBCRU',
                    'description' => 'InaBCRU is an organization dedicated to bat conservation in Indonesia through research, education, and collaboration with various stakeholders.',
                    'founded' => 'Founded on February 5, 2025 in Yogyakarta',
                    'legalId' => 'AHU-0009178.AH.01.07.TAHUN 2025'
                ],
                'visionMission' => [
                    'title' => 'Vision & Mission',
                    'vision' => [
                        'title' => 'Vision',
                        'description' => 'To become a leading organization in bat conservation in Indonesia by building donor institutional credibility and trust.'
                    ],
                    'mission' => [
                        'title' => 'Mission',
                        'items' => [
                            'Conduct scientific research on bats in Indonesia',
                            'Build partnerships with donor and academic institutions',
                            'Organize education and training programs',
                            'Advocate for bat conservation policies'
                        ]
                    ]
                ],
                'team' => [
                    'title' => 'Our Team',
                    'subtitle' => 'A dedicated team of researchers and conservationists'
                ],
                'programs' => [
                    'title' => 'Programs',
                    'subtitle' => 'Our conservation and research programs'
                ],
                'publications' => [
                    'title' => 'Publications',
                    'subtitle' => 'Our scientific publications and research findings',
                    'filterByYear' => 'Filter by year',
                    'allYears' => 'All years',
                    'viewPublication' => 'View Publication',
                    'viewJournal' => 'View Journal',
                    'mediaTypes' => [
                        'pdf' => 'PDF',
                        'images' => 'Images',
                        'video' => 'Video',
                        'youtube' => 'YouTube'
                    ]
                ],
                'news' => [
                    'title' => 'News',
                    'subtitle' => 'Latest news and articles',
                    'readMore' => 'Read More'
                ],
                'impact' => [
                    'title' => 'Our Impact',
                    'subtitle' => 'Results of our hard work in bat conservation'
                ],
                'donate' => [
                    'title' => 'Support Us',
                    'subtitle' => 'Help us protect Indonesian bats',
                    'description' => 'Bats protect our forests, food, and health — help us protect them.',
                    'bankTransfer' => 'Bank Transfer',
                    'bankName' => 'Bank Name',
                    'accountNumber' => 'Account Number',
                    'accountName' => 'Account Name',
                    'donationTiers' => [
                        'title' => 'Donation Packages',
                        'Rp100K' => [
                            'amount' => 'Rp 100,000',
                            'impact' => 'Supports educational materials for one school'
                        ],
                        'Rp500K' => [
                            'amount' => 'Rp 500,000',
                            'impact' => 'Supports one field training session'
                        ],
                        'Rp1M' => [
                            'amount' => 'Rp 1,000,000',
                            'impact' => 'Supports one survey research location'
                        ],
                        'Rp5M' => [
                            'amount' => 'Rp 5,000,000+',
                            'impact' => 'Supports integrated conservation program'
                        ]
                    ],
                    'institutional' => [
                        'title' => 'Institutional Donors',
                        'mouInfo' => 'We provide MoU for institutional donors with complete transparency reports.',
                        'contactForMoU' => 'Contact us for MoU information'
                    ],
                    'ctaQuote' => 'Bats protect our forests, food, and health — help us protect them.'
                ],
                'contact' => [
                    'title' => 'Contact Us',
                    'subtitle' => 'Get in touch with us for more information',
                    'email' => 'Email',
                    'location' => 'Location',
                    'sendMessage' => 'Send Message',
                    'name' => 'Name',
                    'message' => 'Message',
                    'send' => 'Send'
                ],
                'common' => [
                    'loading' => 'Loading...',
                    'error' => 'An error occurred',
                    'close' => 'Close',
                    'previous' => 'Previous',
                    'next' => 'Next',
                    'download' => 'Download',
                    'pageOf' => 'Page {current} of {total}'
                ]
            ]
        ];
    }
    $keys = explode('.', $key);
    $value = $messages[$locale] ?? $messages['id'];
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $key;
        }
    }
    return $value;
}

function getNavItems($locale = 'id') {
    return [
        ['href' => BASE_URL . '/' . $locale, 'label' => t('nav.home', $locale)],
        ['href' => BASE_URL . '/' . $locale . '/about', 'label' => t('nav.about', $locale)],
        ['href' => BASE_URL . '/' . $locale . '/team', 'label' => t('nav.team', $locale)],
        ['href' => BASE_URL . '/' . $locale . '/publications', 'label' => t('nav.publications', $locale)],
        ['href' => BASE_URL . '/' . $locale . '/donate', 'label' => t('nav.donate', $locale)],
    ];
}

function getLocaleFromUri($uri) {
    if (preg_match('/^\/(id|en)\b/', $uri, $matches)) {
        return $matches[1];
    }
    return 'id';
}

function switchLocaleUrl($currentLocale) {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $newLocale = $currentLocale === 'id' ? 'en' : 'id';
    if (preg_match('/^\/(id|en)(\/|$)/', $uri)) {
        return preg_replace('/^\/(id|en)/', '/' . $newLocale, $uri);
    }
    return '/' . $newLocale;
}