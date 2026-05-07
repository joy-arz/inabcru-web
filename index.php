<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/api.php';

$stats = getApi('/stats');
$team = getApi('/team');
$publications = getApi('/publications');

$statsData = [];
if (is_array($stats)) {
    foreach ($stats as $stat) {
        $value = isset($stat['value']) ? intval($stat['value']) : 0;
        $suffix = isset($stat['suffix']) ? htmlspecialchars($stat['suffix']) : '';
        $label = isset($stat['key']) ? htmlspecialchars($stat['key']) : 'Stat';
        $statsData[] = ['value' => $value, 'suffix' => $suffix, 'label' => $label];
    }
}

if (empty($statsData)) {
    $statsData = [
        ['value' => 45, 'suffix' => '+', 'label' => 'Spesies Disurvei'],
        ['value' => 12, 'suffix' => '', 'label' => 'Lokasi Riset'],
        ['value' => 28, 'suffix' => '', 'label' => 'Publikasi Ilmiah'],
        ['value' => 35, 'suffix' => '', 'label' => 'Anggota Aktif'],
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InaBCRU - Indonesia Bat Conservation Research Union</title>
  <meta name="description" content="Perkumpulan Indonesia Bat Conservation Research Union - Membangun kredibilitas donor untuk konservasi kelelawar di Indonesia">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
  <?php require_once __DIR__ . '/includes/header.php'; ?>

  <main>
    <section class="hero">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1548777123-e216912df7d8?w=1920&q=80" alt="Bat in natural habitat">
        <div class="hero-overlay"></div>
        <div class="hero-gradient"></div>
      </div>
      <div class="hero-content container">
        <p class="hero-label">Indonesia Bat Conservation Research Union</p>
        <h1>Indonesia Bat Conservation Research Union</h1>
        <p class="hero-subtitle">Membangun kredibilitas institusi untuk konservasi kelelawar di Indonesia</p>
        <div class="hero-buttons">
          <a href="<?php echo BASE_URL; ?>/donate" class="btn btn-primary btn-lg">Dukung Kami</a>
          <a href="<?php echo BASE_URL; ?>/about" class="btn btn-secondary btn-lg">Tentang</a>
        </div>
      </div>
      <div class="hero-bottom-gradient"></div>
    </section>

    <section class="partners-bar">
      <div class="partners-track">
        <?php
        $partners = [
          ['name' => 'BRIN', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Main_Logo_of_National_Research_and_Innovation_Agency_of_Indonesia.svg'],
          ['name' => 'UGM', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/9/9f/Emblem_of_Universitas_Gadjah_Mada.svg'],
          ['name' => 'ITB', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/9/95/Logo_Institut_Teknologi_Bandung.png'],
          ['name' => 'IPB', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/0/0f/Logo_IPB.png'],
          ['name' => 'Unpad', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/8/80/Lambang_Universitas_Padjadjaran.svg'],
          ['name' => 'UNAIR', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Logo-Branding-UNAIR-biru.png/250px-Logo-Branding-UNAIR-biru.png'],
          ['name' => 'UPI', 'logo' => 'https://upload.wikimedia.org/wikipedia/id/0/09/Logo_Almamater_UPI.svg'],
          ['name' => 'LIPI', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/Logo_LIPI_%282018%29.svg'],
        ];
        $allPartners = array_merge($partners, $partners);
        foreach ($allPartners as $partner):
        ?>
          <div class="partner-item">
            <img src="<?php echo $partner['logo']; ?>" alt="<?php echo $partner['name']; ?>" onerror="this.parentElement.style.display='none'">
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <div class="section-header text-center">
          <p class="section-label">Dampak Kami</p>
          <h2 class="section-title">Dampak Kami</h2>
          <p class="section-subtitle mx-auto">Membangun kredibilitas donor institusi untuk organisasi non-profit konservasi kelelawar di Indonesia.</p>
        </div>
        <div class="stats-grid">
          <?php foreach ($statsData as $stat): ?>
            <div class="stat-card">
              <div class="stat-value"><?php echo $stat['value'] . $stat['suffix']; ?></div>
              <div class="stat-label"><?php echo $stat['label']; ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section-padding bg-surface-warm">
      <div class="container">
        <div class="section-header text-center">
          <p class="section-label">Program Kami</p>
          <h2 class="section-title">Program Kami</h2>
        </div>
        <div class="programs-grid">
          <div class="program-card">
            <div class="program-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <h3>Survei Kelelawar</h3>
            <p>Riset lapangan untuk mengidentifikasi dan memetakan populasi kelelawar di berbagai habitat.</p>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
            </div>
            <h3>Edukasi & Pelatihan</h3>
            <p>Program edukasi untuk meningkatkan kesadaran tentang pentingnya kelelawar.</p>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3>Konservasi Habitat</h3>
            <p>Upaya perlindungan habitat alami kelelawar untuk menjaga keseimbangan ekosistem.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-padding bg-dark text-white relative overflow-hidden">
      <div class="about-overlay">
        <img src="https://images.pexels.com/photos/1682705/pexels-photo-1682705.jpeg?auto=compress&cs=tinysrgb&w=1920" alt="Bat conservation">
      </div>
      <div class="container relative z-10">
        <div class="about-grid">
          <div class="about-content">
            <p class="section-label" style="color: rgba(255,255,255,0.6);">Tentang Kami</p>
            <h2 class="section-title" style="color: white;">Melindungi Kelelawar Indonesia</h2>
            <p class="about-text">InaBCRU adalah organisasi non-profit yang dedicated untuk konservasi kelelawar di Indonesia melalui penelitian ilmiah, edukasi masyarakat, dan kolaborasi dengan berbagai institusi.</p>
            <a href="<?php echo BASE_URL; ?>/about" class="btn btn-primary" style="background: var(--color-primary);">Pelajari Lebih Lanjut</a>
          </div>
          <div class="about-stats-grid">
            <div class="about-stat-card">
              <p class="about-stat-value">45+</p>
              <p class="about-stat-label">Spesies Disurvei</p>
            </div>
            <div class="about-stat-card">
              <p class="about-stat-value">28</p>
              <p class="about-stat-label">Publikasi</p>
            </div>
            <div class="about-stat-card">
              <p class="about-stat-value">12</p>
              <p class="about-stat-label">Lokasi Riset</p>
            </div>
            <div class="about-stat-card">
              <p class="about-stat-value">35</p>
              <p class="about-stat-label">Anggota</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <div class="section-header text-center">
          <p class="section-label">Berita Terbaru</p>
          <h2 class="section-title">Berita Terbaru</h2>
        </div>
        <div class="news-grid">
          <div class="news-card">
            <p class="news-date">2025-03-15</p>
            <h3>Penemuan Kelelawar Baru di Kalimantan</h3>
            <p class="news-excerpt">Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...</p>
          </div>
          <div class="news-card">
            <p class="news-date">2025-03-10</p>
            <h3>Pelatihan Peneliti Muda di Yogyakarta</h3>
            <p class="news-excerpt">Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...</p>
          </div>
          <div class="news-card">
            <p class="news-date">2025-03-05</p>
            <h3>Kolaborasi Riset dengan Universitas Indonesia</h3>
            <p class="news-excerpt">Tim peneliti kami baru saja menyelesaikan survei kelelawar di kawasan hutan Sulawesi...</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-padding bg-dark text-white relative overflow-hidden">
      <div class="cta-overlay">
        <img src="https://images.unsplash.com/photo-1548777123-e216912df7d8?w=1920&q=80" alt="Bat conservation">
      </div>
      <div class="container relative z-10 text-center">
        <blockquote class="cta-quote">"Kelelawar melindungi hutan, pangan, dan kesehatan kita — bantu kami melindungi mereka."</blockquote>
        <a href="<?php echo BASE_URL; ?>/donate" class="btn btn-primary btn-lg">Donasi Sekarang</a>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

<style>
.hero {
  position: relative;
  min-height: 100svh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
}

.hero-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 17, 23, 0.75);
}

.hero-gradient {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(43, 57, 132, 0.3) 0%, transparent 50%, rgba(43, 57, 132, 0.1) 100%);
}

.hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  padding: 0 24px;
}

.hero-label {
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.12em;
  color: rgba(255,255,255,0.6);
  margin-bottom: 24px;
}

.hero h1 {
  font-size: clamp(36px, 6vw, 72px);
  font-weight: 700;
  color: white;
  margin-bottom: 24px;
  line-height: 1.1;
}

.hero-subtitle {
  font-size: 18px;
  color: rgba(255,255,255,0.7);
  max-width: 640px;
  margin: 0 auto 40px;
}

.hero-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.hero-bottom-gradient {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 128px;
  background: linear-gradient(to top, var(--color-background), transparent);
}

.partners-bar {
  background: var(--color-surface-warm);
  padding: 40px 0;
  overflow: hidden;
  border-top: 1px solid var(--color-border);
  border-bottom: 1px solid var(--color-border);
}

.partners-track {
  display: flex;
  gap: 48px;
  width: max-content;
  animation: marquee-logos 35s linear infinite;
}

.partner-item {
  flex-shrink: 0;
  height: 56px;
  width: 176px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.partner-item img {
  height: 100%;
  width: 100%;
  object-fit: contain;
  filter: grayscale(100%);
  opacity: 0.7;
  transition: all 0.3s;
}

.partner-item img:hover {
  filter: grayscale(0%);
  opacity: 1;
}

.section-header {
  margin-bottom: 64px;
}

.section-header.text-center {
  text-align: center;
}

.section-header .section-subtitle {
  margin: 0 auto;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 32px;
}

.stat-card {
  text-align: center;
}

.stat-value {
  font-family: 'Playfair Display', serif;
  font-size: 48px;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: 8px;
}

.stat-label {
  color: var(--color-muted);
  font-size: 14px;
  font-weight: 500;
}

.programs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.program-card {
  background: var(--color-background);
  border-radius: 16px;
  padding: 32px;
  border: 1px solid var(--color-border);
  transition: box-shadow 0.3s;
}

.program-card:hover {
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
}

.program-icon {
  width: 56px;
  height: 56px;
  border-radius: 12px;
  background: rgba(43, 57, 132, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin-bottom: 24px;
}

.program-icon svg {
  width: 24px;
  height: 24px;
}

.program-card h3 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 12px;
}

.program-card p {
  color: var(--color-muted);
  line-height: 1.7;
}

.about-overlay {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.about-overlay img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.2;
}

.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
}

.about-text {
  color: rgba(255,255,255,0.7);
  line-height: 1.8;
  margin-bottom: 24px;
}

.about-stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

.about-stat-card {
  background: rgba(255,255,255,0.05);
  border-radius: 16px;
  padding: 24px;
  border: 1px solid rgba(255,255,255,0.1);
}

.about-stat-value {
  font-size: 36px;
  font-weight: 700;
  color: white;
  margin-bottom: 4px;
}

.about-stat-label {
  font-size: 14px;
  color: rgba(255,255,255,0.6);
}

.news-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.news-card {
  background: var(--color-surface-warm);
  border-radius: 16px;
  padding: 24px;
  border: 1px solid var(--color-border);
  transition: box-shadow 0.3s;
}

.news-card:hover {
  box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}

.news-date {
  color: var(--color-muted);
  font-size: 12px;
  margin-bottom: 8px;
}

.news-card h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 12px;
}

.news-excerpt {
  color: var(--color-muted);
  font-size: 14px;
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.cta-overlay {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.cta-overlay img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.3;
}

.cta-quote {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 32px;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

.relative.z-10 {
  position: relative;
  z-index: 10;
}

@keyframes marquee-logos {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

@media (max-width: 1024px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .programs-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .about-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .stats-grid,
  .programs-grid,
  .news-grid {
    grid-template-columns: 1fr;
  }

  .about-stats-grid {
    grid-template-columns: 1fr;
  }

  .hero-buttons {
    flex-direction: column;
  }
}
</style>