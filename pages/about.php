<?php
require_once __DIR__ . '/../includes/config.php';
$currentLocale = getLocaleFromUri($_SERVER['REQUEST_URI'] ?? '/');
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLocale; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo t('about.title', $currentLocale); ?></title>
  <meta name="description" content="<?php echo t('about.description', $currentLocale); ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
  <?php require_once __DIR__ . '/../includes/header.php'; ?>

  <main>
    <section class="page-hero">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1920&q=80" alt="About InaBCRU">
        <div class="hero-overlay"></div>
      </div>
      <div class="hero-content container">
        <p class="hero-label"><?php echo t('nav.about', $currentLocale); ?></p>
        <h1><?php echo t('about.title', $currentLocale); ?></h1>
        <p class="hero-subtitle"><?php echo $currentLocale === 'id' ? 'Organisasi yang didedikasikan untuk konservasi kelelawar di Indonesia' : 'An organization dedicated to bat conservation in Indonesia'; ?></p>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container-narrow">
        <div class="about-section">
          <h2><?php echo t('home.mission.title', $currentLocale); ?></h2>
          <p class="lead"><?php echo t('home.mission.description', $currentLocale); ?></p>
          
          <div class="vision-mission-grid">
            <div class="vm-card">
              <h3><?php echo t('visionMission.vision.title', $currentLocale); ?></h3>
              <p><?php echo t('visionMission.vision.description', $currentLocale); ?></p>
            </div>
            <div class="vm-card">
              <h3><?php echo t('visionMission.mission.title', $currentLocale); ?></h3>
              <ul>
                <?php foreach (t('visionMission.mission.items', $currentLocale) as $item): ?>
                  <li><?php echo $item; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="about-section">
          <h2><?php echo $currentLocale === 'id' ? 'Tentang Organisasi' : 'About the Organization'; ?></h2>
          <p><?php echo t('about.description', $currentLocale); ?></p>
          <p><?php echo t('about.founded', $currentLocale); ?></p>
          <p class="legal-id">Legal ID: <?php echo t('footer.legalId', $currentLocale); ?></p>
        </div>
      </div>
    </section>

    <section class="section-padding bg-surface-warm">
      <div class="container">
        <div class="section-header text-center">
          <p class="section-label"><?php echo $currentLocale === 'id' ? 'Nilai Kami' : 'Our Values'; ?></p>
          <h2 class="section-title"><?php echo $currentLocale === 'id' ? 'Prinsip Kerja Kami' : 'Our Working Principles'; ?></h2>
        </div>
        <div class="values-grid">
          <div class="value-card">
            <div class="value-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h3><?php echo $currentLocale === 'id' ? 'Keilmuan' : 'Scientific'; ?></h3>
            <p><?php echo $currentLocale === 'id' ? 'Kami berbasis pada penelitian ilmiah dan data yang valid untuk mendukung konservasi kelelawar.' : 'We are based on scientific research and valid data to support bat conservation.'; ?></p>
          </div>
          <div class="value-card">
            <div class="value-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <h3><?php echo $currentLocale === 'id' ? 'Kolaborasi' : 'Collaboration'; ?></h3>
            <p><?php echo $currentLocale === 'id' ? 'Kami bekerja sama dengan berbagai institusi, universitas, dan komunitas untuk seringk positif.' : 'We collaborate with various institutions, universities, and communities for positive change.'; ?></p>
          </div>
          <div class="value-card">
            <div class="value-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
              </svg>
            </div>
            <h3><?php echo $currentLocale === 'id' ? 'Edukasi' : 'Education'; ?></h3>
            <p><?php echo $currentLocale === 'id' ? 'Kami meningkatkan kesadaran masyarakat tentang pentingnya kelelawar bagi ekosistem.' : 'We raise public awareness about the importance of bats for the ecosystem.'; ?></p>
          </div>
          <div class="value-card">
            <div class="value-icon">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3><?php echo $currentLocale === 'id' ? 'Pelestarian' : 'Preservation'; ?></h3>
            <p><?php echo $currentLocale === 'id' ? 'Kami melindungi habitat alami kelelawar untuk menjaga keseimbangan ekosistem Indonesia.' : 'We protect natural bat habitats to maintain the balance of Indonesia\'s ecosystem.'; ?></p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-padding bg-primary text-white">
      <div class="container text-center">
        <h2 class="section-title" style="color: white; margin-bottom: 24px;"><?php echo $currentLocale === 'id' ? 'Bergabung dengan Kami' : 'Join Us'; ?></h2>
        <p style="max-width: 640px; margin: 0 auto 32px; opacity: 0.9;"><?php echo $currentLocale === 'id' ? 'Kami selalu mencari sukarelawan dan peneliti yang passionate tentang konservasi kelelawar.' : 'We are always looking for volunteers and researchers passionate about bat conservation.'; ?></p>
        <a href="mailto:info.inabcru@gmail.com" class="btn btn-secondary btn-lg"><?php echo t('contact.title', $currentLocale); ?></a>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>

<style>
.page-hero {
  position: relative;
  padding: 160px 0 100px;
  overflow: hidden;
}

.page-hero .hero-bg {
  position: absolute;
  inset: 0;
}

.page-hero .hero-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.page-hero .hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(15, 17, 23, 0.8);
}

.page-hero .hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
}

.page-hero .hero-label {
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.12em;
  color: rgba(255,255,255,0.6);
  margin-bottom: 16px;
}

.page-hero h1 {
  font-size: 48px;
  font-weight: 700;
  color: white;
  margin-bottom: 16px;
}

.page-hero .hero-subtitle {
  font-size: 18px;
  color: rgba(255,255,255,0.7);
  max-width: 640px;
  margin: 0 auto;
}

.about-section {
  margin-bottom: 64px;
}

.about-section h2 {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 24px;
}

.about-section .lead {
  font-size: 20px;
  color: var(--color-muted);
  line-height: 1.6;
  margin-bottom: 32px;
}

.about-section p {
  color: var(--color-muted);
  line-height: 1.8;
  margin-bottom: 16px;
}

.about-section .legal-id {
  font-size: 14px;
  color: var(--color-primary);
  margin-top: 32px;
  padding-top: 24px;
  border-top: 1px solid var(--color-border);
}

.vision-mission-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  margin-top: 32px;
}

.vm-card {
  background: var(--color-surface-warm);
  padding: 32px;
  border-radius: 16px;
}

.vm-card h3 {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 16px;
  color: var(--color-primary);
}

.vm-card p,
.vm-card li {
  color: var(--color-muted);
  line-height: 1.7;
}

.vm-card ul {
  padding-left: 20px;
}

.vm-card li {
  margin-bottom: 8px;
}

.values-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.value-card {
  background: var(--color-background);
  border-radius: 16px;
  padding: 32px;
  border: 1px solid var(--color-border);
  text-align: center;
}

.value-icon {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  background: rgba(43, 57, 132, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin: 0 auto 20px;
}

.value-icon svg {
  width: 32px;
  height: 32px;
}

.value-card h3 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 12px;
}

.value-card p {
  color: var(--color-muted);
  font-size: 14px;
  line-height: 1.6;
}

@media (max-width: 1024px) {
  .values-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .vision-mission-grid {
    grid-template-columns: 1fr;
  }

  .values-grid {
    grid-template-columns: 1fr;
  }

  .page-hero h1 {
    font-size: 36px;
  }
}
</style>