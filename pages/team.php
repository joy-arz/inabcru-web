<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

$currentLocale = getLocaleFromUri($_SERVER['REQUEST_URI'] ?? '/');
$team = getApi('/team') ?? [];
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLocale; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo t('team.title', $currentLocale); ?> | InaBCRU</title>
  <meta name="description" content="<?php echo t('team.subtitle', $currentLocale); ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
  <?php require_once __DIR__ . '/../includes/header.php'; ?>

  <main>
    <section class="page-hero">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1920&q=80" alt="Our team">
        <div class="hero-overlay"></div>
      </div>
      <div class="hero-content container">
        <p class="hero-label"><?php echo t('nav.team', $currentLocale); ?></p>
        <h1><?php echo t('team.title', $currentLocale); ?></h1>
        <p class="hero-subtitle"><?php echo t('team.subtitle', $currentLocale); ?></p>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <div class="team-grid">
          <?php
          if (!empty($team)):
            foreach ($team as $member):
          ?>
            <div class="team-card">
              <div class="team-avatar">
                <?php if (!empty($member['photo_url'])): ?>
                  <img src="<?php echo htmlspecialchars($member['photo_url']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                <?php else: ?>
                  <svg viewBox="0 0 100 100" fill="currentColor">
                    <path d="M50 10c-5 0-9 4-9 9v6c-8 3-14 11-14 20 0 12 9 22 20 24v5c0 3 2 5 5 5h8c3 0 5-2 5-5v-5c11-2 20-12 20-24 0-9-6-17-14-20v-6c0-5-4-9-9-9h-12zm-3 9c0-2 2-4 4-4s4 2 4 4v6c0 2-2 4-4 4s-4-2-4-4v-6zm6 22c8 0 14 4 14 10 0 3-1 5-3 6l2 7H34l2-7c-2-1-3-3-3-6 0-6 6-10 14-10h8z"/>
                  </svg>
                <?php endif; ?>
              </div>
              <h3><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role"><?php echo htmlspecialchars($member['title'] ?? ''); ?></p>
              <p class="team-bio"><?php echo htmlspecialchars($member['bio'] ?? ''); ?></p>
            </div>
          <?php
            endforeach;
          else:
            $defaultTeam = [
              ['name' => 'Dr. Budi Santoso', 'title' => $currentLocale === 'id' ? 'Ketua Umum' : 'Chairman', 'bio' => $currentLocale === 'id' ? 'Ahli biologi kelelawar dengan pengalaman 15 tahun dalam penelitian konservasi.' : 'Bat biology expert with 15 years of experience in conservation research.'],
              ['name' => 'Dr. Siti Nurhaliza', 'title' => $currentLocale === 'id' ? 'Wakil Ketua' : 'Vice Chairman', 'bio' => $currentLocale === 'id' ? 'Spesialis ekologi kelelawar dan habitat conservation expert.' : 'Bat ecology and habitat conservation specialist.'],
              ['name' => 'Ahmad Hidayat', 'title' => $currentLocale === 'id' ? 'Sekretaris' : 'Secretary', 'bio' => $currentLocale === 'id' ? 'Koordinator program lapangan dan pengelolaan data penelitian.' : 'Field program coordinator and research data management.'],
              ['name' => 'Dewi Kusuma', 'title' => $currentLocale === 'id' ? 'Bendahara' : 'Treasurer', 'bio' => $currentLocale === 'id' ? 'Ahli keuangan dengan pengalaman di organisasi non-profit.' : 'Finance expert with experience in non-profit organizations.'],
              ['name' => 'Dr. Rahman Firdaus', 'title' => $currentLocale === 'id' ? 'Peneliti Senior' : 'Senior Researcher', 'bio' => $currentLocale === 'id' ? 'Spesialis genetika kelelawar dan taksonomi.' : 'Bat genetics and taxonomy specialist.'],
              ['name' => 'Lisa Permata', 'title' => $currentLocale === 'id' ? 'Koordinator Edukasi' : 'Education Coordinator', 'bio' => $currentLocale === 'id' ? 'Spesialis pendidikan lingkungan dan program komunitas.' : 'Environmental education and community program specialist.'],
              ['name' => 'Dr. Ahmad Wijaya', 'title' => $currentLocale === 'id' ? 'Peneliti' : 'Researcher', 'bio' => $currentLocale === 'id' ? 'Spesialis perilaku kelelawar dan survei akustik.' : 'Bat behavior and acoustic survey specialist.'],
              ['name' => 'Rina Setiawan', 'title' => $currentLocale === 'id' ? 'Koordinator Lapangan' : 'Field Coordinator', 'bio' => $currentLocale === 'id' ? 'Koordinator kegiatan survei lapangan dan partisipasi komunitas.' : 'Field survey and community participation coordinator.'],
            ];
            foreach ($defaultTeam as $member):
          ?>
            <div class="team-card">
              <div class="team-avatar">
                <svg viewBox="0 0 100 100" fill="currentColor">
                  <path d="M50 10c-5 0-9 4-9 9v6c-8 3-14 11-14 20 0 12 9 22 20 24v5c0 3 2 5 5 5h8c3 0 5-2 5-5v-5c11-2 20-12 20-24 0-9-6-17-14-20v-6c0-5-4-9-9-9h-12zm-3 9c0-2 2-4 4-4s4 2 4 4v6c0 2-2 4-4 4s-4-2-4-4v-6zm6 22c8 0 14 4 14 10 0 3-1 5-3 6l2 7H34l2-7c-2-1-3-3-3-6 0-6 6-10 14-10h8z"/>
                </svg>
              </div>
              <h3><?php echo $member['name']; ?></h3>
              <p class="team-role"><?php echo $member['title']; ?></p>
              <p class="team-bio"><?php echo $member['bio']; ?></p>
            </div>
          <?php
            endforeach;
          endif;
          ?>
        </div>
      </div>
    </section>

    <section class="section-padding bg-surface-warm border-t border-border">
      <div class="container text-center">
        <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 16px;"><?php echo $currentLocale === 'id' ? 'Bergabung dengan Tim Kami' : 'Join Our Team'; ?></h2>
        <p style="color: var(--color-muted); max-width: 480px; margin: 0 auto 24px;"><?php echo $currentLocale === 'id' ? 'Kami selalu mencari sukarelawan dan peneliti yang passionate tentang konservasi kelelawar.' : 'We are always looking for volunteers and researchers passionate about bat conservation.'; ?></p>
        <a href="mailto:info.inabcru@gmail.com" class="contact-link">info.inabcru@gmail.com</a>
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

.team-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 32px;
}

.team-card {
  text-align: center;
}

.team-avatar {
  width: 96px;
  height: 96px;
  border-radius: 50%;
  background: var(--color-surface-warm);
  margin: 0 auto 16px;
  overflow: hidden;
  border: 2px solid var(--color-border);
}

.team-avatar svg {
  width: 100%;
  height: 100%;
  color: var(--color-primary);
  opacity: 0.2;
}

.team-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.team-card:hover .team-avatar {
  border-color: var(--color-primary);
}

.team-card h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
}

.team-role {
  color: var(--color-cta);
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 12px;
}

.team-bio {
  color: var(--color-muted);
  font-size: 14px;
  line-height: 1.6;
}

.contact-link {
  color: var(--color-primary);
  font-weight: 500;
}

.contact-link:hover {
  text-decoration: underline;
}

@media (max-width: 1024px) {
  .team-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 768px) {
  .team-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .team-grid {
    grid-template-columns: 1fr;
  }
}
</style>