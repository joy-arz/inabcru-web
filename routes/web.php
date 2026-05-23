<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SiteImageController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\ProgramController;
use App\Models\Publication;
use App\Models\Article;
use App\Models\TeamMember;
use App\Models\Partner;
use Illuminate\Support\Facades\Route;

function getTranslations(string $locale): array {
    $file = base_path("resources/lang/{$locale}.json");
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return [];
}

function trans_for(string $key, ?string $locale = null): string {
    $locale = $locale ?? app()->getLocale();
    static $translations = [];

    if (!isset($translations[$locale])) {
        $translations[$locale] = getTranslations($locale);
    }

    $keys = explode('.', $key);
    $value = $translations[$locale] ?? [];

    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $key;
        }
        $value = $value[$k];
    }

    return $value;
}

Route::get('/', function () {
    return redirect('/id');
});

Route::get('/{locale}', function ($locale) {
    if (!in_array($locale, ['id', 'en'])) {
        return redirect('/id');
    }
    app()->setLocale($locale);
    $latestArticles = Article::where('published', true)->orderBy('created_at', 'desc')->take(3)->get();
    $partners = Partner::orderBy('display_order')->get();
    $donationEnabled = false;
    return view('pages.home', ['locale' => $locale, 'latestArticles' => $latestArticles, 'partners' => $partners, 'donationEnabled' => $donationEnabled]);
})->where('locale', 'id|en');

Route::get('/{locale}/{page}', function ($locale, $page) {
    if (!in_array($locale, ['id', 'en'])) {
        return redirect('/id');
    }
    app()->setLocale($locale);

    $donationEnabled = false;
    $validPages = ['about-us', 'donate', 'programs', 'impact', 'contact'];

    if ($page === 'home') {
        return redirect("/{$locale}");
    }

    if ($page === 'publications') {
        $publications = Publication::orderBy('year', 'desc')->get();
        return view('pages.publications', compact('locale', 'publications', 'donationEnabled'));
    }

    if ($page === 'news') {
        $articles = Article::where('published', true)->orderBy('created_at', 'desc')->get();
        return view('pages.news', compact('locale', 'articles', 'donationEnabled'));
    }

    if ($page === 'mitra') {
        $partners = Partner::where('active', true)->orderBy('display_order')->get();
        return view('pages.mitra', compact('locale', 'partners', 'donationEnabled'));
    }

    if (in_array($page, $validPages)) {
        $data = ['locale' => $locale, 'donationEnabled' => $donationEnabled];
        if ($page === 'about-us') {
            $data['teamMembers'] = TeamMember::orderBy('display_order')->get();
            $data['divisions'] = \App\Models\Division::where('active', true)->orderBy('display_order')->get();
        }
        if ($page === 'programs') {
            $data['divisions'] = \App\Models\Division::where('active', true)->orderBy('display_order')->with('programs')->get();
            $data['programsJson'] = \App\Models\Program::where('active', true)->get()->map(function($p) {
                return [
                    'id' => $p->id,
                    'title_id' => $p->title_id,
                    'title_en' => $p->title_en,
                    'short_description_id' => $p->short_description_id,
                    'short_description_en' => $p->short_description_en,
                    'description_id' => $p->description_id,
                    'description_en' => $p->description_en,
                    'icon' => $p->icon,
                    'featured_image_url' => $p->featured_image_url,
                    'featured_image_alt' => $p->featured_image_alt,
                    'carousel_images' => $p->carousel_images ?? [],
                ];
            });
        }
        return view("pages.{$page}", $data);
    }

    return redirect("/{$locale}");
})->where('locale', 'id|en');

Route::get('/{locale}/news/{slug}', function ($locale, $slug) {
    if (!in_array($locale, ['id', 'en'])) {
        return redirect('/id');
    }
    app()->setLocale($locale);
    $donationEnabled = false;

    $article = Article::where('slug', $slug)->where('published', true)->firstOrFail();
    $sidebarArticles = Article::where('published', true)
        ->where('id', '!=', $article->id)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    return view('pages.news-detail', compact('locale', 'article', 'sidebarArticles', 'donationEnabled'));
})->where('locale', 'id|en');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'publications' => Publication::count(),
            'articles' => Article::count(),
            'members' => TeamMember::count(),
        ];
        $recentPublications = Publication::latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentPublications', 'recentArticles'));
    })->name('dashboard');

    Route::resource('publications', PublicationController::class)->except(['show']);
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::resource('team', TeamController::class)->except(['show']);
    Route::resource('partners', PartnerController::class)->except(['show']);
    Route::resource('divisions', DivisionController::class)->except(['show']);
    Route::resource('programs', ProgramController::class)->except(['show']);
    Route::resource('site-images', SiteImageController::class)->only(['index', 'edit', 'update']);
    Route::match(['get', 'put'], '/stats', [StatsController::class, 'index'])->name('stats');
    Route::post('/team/reorder', [TeamController::class, 'reorder'])->name('team.reorder');
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
});

Route::get('/admin', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// SETUP ROUTE - Remove after first run for security
Route::get('/setup', function() {
    \Artisan::call('migrate:fresh', ['--force' => true]);

    \App\Models\User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@inabcru.org',
        'password' => bcrypt('password123'),
    ]);

    $stats = [
        ['label_id' => 'Spesies Kelelawar', 'label_en' => 'Bat Species', 'value' => '175+', 'icon' => '🦇', 'display_order' => 1],
        ['label_id' => 'Peneliti Aktif', 'label_en' => 'Active Researchers', 'value' => '45', 'icon' => '👨‍🔬', 'display_order' => 2],
        ['label_id' => 'Publikasi Ilmiah', 'label_en' => 'Scientific Publications', 'value' => '120+', 'icon' => '📚', 'display_order' => 3],
        ['label_id' => 'Lokasi Riset', 'label_en' => 'Research Sites', 'value' => '25', 'icon' => '🌍', 'display_order' => 4],
    ];
    foreach ($stats as $stat) {
        \App\Models\ImpactStat::create($stat);
    }

    $publications = [
        [
            'title_id' => 'Keanekaragaman dan Distribusi Kelelawar Buah di Sulawesi',
            'title_en' => 'Diversity and Distribution of Fruit Bats in Sulawesi',
            'journal' => 'Journal of Bat Research',
            'year' => 2024,
            'doi' => 'https://doi.org/10.1234/example',
            'cover_image_url' => 'https://images.unsplash.com/photo-1548550023-2bdb3c5a0e7e?w=800',
            'content_blocks' => json_encode([
                ['type' => 'pdf', 'url' => 'https://arxiv.org/pdf/2312.04163.pdf', 'title' => 'Research Paper'],
                ['type' => 'video', 'url' => 'https://www.w3schools.com/html/mov_bbb.mp4', 'title' => 'Bat Research Video'],
                ['type' => 'image', 'url' => 'https://images.unsplash.com/photo-1548550023-2bdb3c5a0e7e?w=800', 'title' => 'Bat Habitat'],
            ]),
        ],
        [
            'title_id' => 'Survei Kelelawar di Kawasan Ekosistem Leuser',
            'title_en' => 'Bat Survey in Leuser Ecosystem Area',
            'journal' => 'Forest Research Journal',
            'year' => 2022,
            'doi' => 'https://doi.org/10.1234/leuser',
            'cover_image_url' => 'https://images.unsplash.com/photo-1518709766631-a6a3f9c8a2b5?w=800',
        ],
    ];
    foreach ($publications as $pub) {
        \App\Models\Publication::create($pub);
    }

    $articles = [
        [
            'title_id' => 'Tim Kami Menyelesaikan Survei Kelelawar di Sulawesi',
            'title_en' => 'Our Team Completes Bat Survey in Sulawesi',
            'content_id' => 'Tim peneliti InaBCRU baru saja menyelesaikan survei kelelawar selama 2 minggu di kawasan hutan Sulawesi.',
            'content_en' => 'The InaBCRU research team has just completed a 2-week bat survey in the Sulawesi forest region.',
            'category' => 'news',
            'featured_image_url' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800',
            'published' => true,
        ],
        [
            'title_id' => 'Pelatihan Penelitian Kelelawar untuk Mahasiswa',
            'title_en' => 'Bat Research Training for Students',
            'content_id' => 'Sebanyak 25 mahasiswa dari berbagai universitas mengikuti pelatihan penelitian kelelawar di Yogyakarta.',
            'content_en' => 'A total of 25 students from various universities participated in bat research training in Yogyakarta.',
            'category' => 'event',
            'featured_image_url' => 'https://images.unsplash.com/photo-1559948846-3a3b8f7f8b8a?w=800',
            'published' => true,
        ],
        [
            'title_id' => 'InaBCRU Hadir di Konferensi Konservasi Asia',
            'title_en' => 'InaBCRU Attends Asia Conservation Conference',
            'content_id' => 'InaBCRU menyampaikan presentasi tentang konservasi kelelawar di konferensi tahunan Asia Conservation.',
            'content_en' => 'InaBCRU presented on bat conservation at the annual Asia Conservation conference.',
            'category' => 'news',
            'featured_image_url' => 'https://images.unsplash.com/photo-1508672019048-805c876b67e2?w=800',
            'published' => true,
        ],
    ];
    foreach ($articles as $article) {
        \App\Models\Article::create($article);
    }

    $team = [
        ['name' => 'Dr. Budi Santoso', 'title_id' => 'Ketua Umum', 'title_en' => 'Chairman', 'bio_id' => 'Ahli biologi kelelawar dengan pengalaman 15 tahun dalam penelitian konservasi.', 'bio_en' => 'Bat biologist with 15 years of experience in conservation research.', 'display_order' => 1],
        ['name' => 'Dr. Siti Nurhaliza', 'title_id' => 'Wakil Ketua', 'title_en' => 'Vice Chairman', 'bio_id' => 'Spesialis ekologi kelelawar dan habitat conservation expert.', 'bio_en' => 'Bat ecology specialist and habitat conservation expert.', 'display_order' => 2],
        ['name' => 'Ahmad Hidayat', 'title_id' => 'Sekretaris', 'title_en' => 'Secretary', 'bio_id' => 'Koordinator program lapangan dan pengelolaan data penelitian.', 'bio_en' => 'Field program coordinator and research data management.', 'display_order' => 3],
        ['name' => 'Dewi Kusuma', 'title_id' => 'Bendahara', 'title_en' => 'Treasurer', 'bio_id' => 'Ahli keuangan dengan pengalaman di organisasi non-profit.', 'bio_en' => 'Finance expert with experience in non-profit organizations.', 'display_order' => 4],
        ['name' => 'Dr. Rahman Firdaus', 'title_id' => 'Peneliti Senior', 'title_en' => 'Senior Researcher', 'bio_id' => 'Spesialis genetika kelelawar dan taksonomi.', 'bio_en' => 'Bat genetics and taxonomy specialist.', 'display_order' => 5],
        ['name' => 'Lisa Permata', 'title_id' => 'Koordinator Edukasi', 'title_en' => 'Education Coordinator', 'bio_id' => 'Spesialis pendidikan lingkungan dan program komunitas.', 'bio_en' => 'Environmental education and community programs specialist.', 'display_order' => 6],
    ];
    foreach ($team as $member) {
        \App\Models\TeamMember::create($member);
    }

    return response('Setup complete! Delete this route from web.php for security.');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';