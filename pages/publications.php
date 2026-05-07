<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

$publications = getApi('/publications') ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publikasi | InaBCRU</title>
  <meta name="description" content="Publikasi ilmiah dan hasil penelitian kami tentang kelelawar di Indonesia">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
  <?php require_once __DIR__ . '/../includes/header.php'; ?>

  <main>
    <section class="page-hero">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=1920&q=80" alt="Publications">
        <div class="hero-overlay"></div>
      </div>
      <div class="hero-content container">
        <p class="hero-label">Publikasi</p>
        <h1>Publikasi</h1>
        <p class="hero-subtitle">Publikasi ilmiah dan hasil penelitian kami</p>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <?php if (!empty($publications)): ?>
          <div class="publications-grid">
            <?php foreach ($publications as $pub): ?>
              <div class="publication-card">
                <?php if (!empty($pub['cover_image'])): ?>
                  <div class="pub-cover">
                    <img src="<?php echo htmlspecialchars($pub['cover_image']); ?>" alt="<?php echo htmlspecialchars($pub['title']); ?>">
                  </div>
                <?php endif; ?>
                <div class="pub-content">
                  <p class="pub-date"><?php echo date('F j, Y', strtotime($pub['date'] ?? '2025-01-01')); ?></p>
                  <h3><?php echo htmlspecialchars($pub['title']); ?></h3>
                  <p class="pub-journal"><?php echo htmlspecialchars($pub['journal'] ?? ''); ?></p>
                  <?php if (!empty($pub['content_blocks'])): ?>
                    <div class="pub-media">
                      <?php foreach ($pub['content_blocks'] as $block): ?>
                        <?php if ($block['type'] === 'pdf'): ?>
                          <a href="<?php echo htmlspecialchars($block['url']); ?>" target="_blank" class="media-link pdf">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            PDF
                          </a>
                        <?php elseif ($block['type'] === 'youtube'): ?>
                          <a href="<?php echo htmlspecialchars($block['url']); ?>" target="_blank" class="media-link video">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Video
                          </a>
                        <?php elseif ($block['type'] === 'image'): ?>
                          <a href="<?php echo htmlspecialchars($block['url']); ?>" target="_blank" class="media-link image">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Gallery
                          </a>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="publications-grid">
            <?php
            $mockPublications = [
              ['title' => 'Diversity and Distribution of Fruit Bats in Sulawesi', 'journal' => 'Journal of Bat Research', 'date' => '2024-03-15', 'cover_image' => 'https://picsum.photos/seed/bat1/800/450'],
              ['title' => 'KEANEKARAGAMAN KELELAWAR DI TAMAN NASIONAL LORE LINDU', 'journal' => 'Indonesian Journal of Conservation', 'date' => '2024-02-20', 'cover_image' => 'https://picsum.photos/seed/bat2/800/450'],
              ['title' => 'Habitat Preference of Echolocating Bats in Java', 'journal' => 'Biodiversity Journal', 'date' => '2023-11-10', 'cover_image' => 'https://picsum.photos/seed/bat3/800/450'],
              ['title' => 'Populasi Kelelawar Penghisap Darah di Kalimantan', 'journal' => 'Veterinary Journal', 'date' => '2023-08-25', 'cover_image' => 'https://picsum.photos/seed/bat4/800/450'],
              ['title' => 'Conservation Status of endemic Bats in Papua', 'journal' => 'Endangered Species Research', 'date' => '2023-05-15', 'cover_image' => 'https://picsum.photos/seed/bat5/800/450'],
              ['title' => 'Survey Kelelawar di Kawasan Ekosistem Leuser', 'journal' => 'Forest Research Journal', 'date' => '2022-12-01', 'cover_image' => 'https://picsum.photos/seed/bat6/800/450'],
            ];
            foreach ($mockPublications as $pub):
            ?>
              <div class="publication-card">
                <div class="pub-cover">
                  <img src="<?php echo $pub['cover_image']; ?>" alt="<?php echo htmlspecialchars($pub['title']); ?>">
                </div>
                <div class="pub-content">
                  <p class="pub-date"><?php echo date('F j, Y', strtotime($pub['date'])); ?></p>
                  <h3><?php echo htmlspecialchars($pub['title']); ?></h3>
                  <p class="pub-journal"><?php echo $pub['journal']; ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>

<style>
.publications-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.publication-card {
  background: var(--color-surface-warm);
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid var(--color-border);
  transition: transform 0.3s, box-shadow 0.3s;
}

.publication-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px -8px rgba(0,0,0,0.15);
}

.pub-cover {
  aspect-ratio: 16/9;
  overflow: hidden;
}

.pub-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.pub-content {
  padding: 24px;
}

.pub-date {
  font-size: 12px;
  color: var(--color-muted);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  margin-bottom: 8px;
}

.pub-content h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
  line-height: 1.4;
}

.pub-journal {
  color: var(--color-primary);
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 16px;
}

.pub-media {
  display: flex;
  gap: 8px;
}

.media-link {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 6px 12px;
  background: var(--color-background);
  border-radius: 6px;
  font-size: 12px;
  font-weight: 500;
  color: var(--color-muted);
  border: 1px solid var(--color-border);
}

.media-link:hover {
  border-color: var(--color-primary);
  color: var(--color-primary);
}

@media (max-width: 1024px) {
  .publications-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .publications-grid {
    grid-template-columns: 1fr;
  }
}
</style>