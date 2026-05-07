<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

$currentLocale = getLocaleFromUri($_SERVER['REQUEST_URI'] ?? '/');
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLocale; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo t('donate.title', $currentLocale); ?> | InaBCRU</title>
  <meta name="description" content="<?php echo t('donate.subtitle', $currentLocale); ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
  <style>
    .toast {
      position: fixed;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--color-text);
      color: white;
      padding: 16px 24px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 12px;
      z-index: 1000;
      animation: fadeUp 0.3s ease;
    }
    .toast svg { color: #22c55e; }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateX(-50%) translateY(20px); }
      to { opacity: 1; transform: translateX(-50%) translateY(0); }
    }
  </style>
</head>
<body>
  <?php require_once __DIR__ . '/../includes/header.php'; ?>

  <main>
    <section class="page-hero">
      <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1559060145-5357d84e7d09?w=1920&q=80" alt="Conservation effort">
        <div class="hero-overlay"></div>
      </div>
      <div class="hero-content container">
        <p class="hero-label"><?php echo t('nav.donate', $currentLocale); ?></p>
        <h1><?php echo t('donate.title', $currentLocale); ?></h1>
        <p class="hero-subtitle"><?php echo t('donate.subtitle', $currentLocale); ?></p>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <div class="donate-grid">
          <div class="donate-info">
            <h2><?php echo t('donate.bankTransfer', $currentLocale); ?></h2>
            
            <div class="bank-card">
              <div class="bank-row">
                <span class="bank-label"><?php echo t('donate.bankName', $currentLocale); ?></span>
                <span class="bank-value">Bank Central Asia (BCA)</span>
              </div>
              <div class="bank-row">
                <span class="bank-label"><?php echo t('donate.accountNumber', $currentLocale); ?></span>
                <span class="bank-value bank-account">1234567890</span>
              </div>
              <div class="bank-row">
                <span class="bank-label"><?php echo t('donate.accountName', $currentLocale); ?></span>
                <span class="bank-value">InaBCRU</span>
              </div>
            </div>

            <button class="btn btn-primary copy-btn" onclick="copyAccount('1234567890', 'bank')">
              <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
              <?php echo $currentLocale === 'id' ? 'Salin Nomor Rekening' : 'Copy Account Number'; ?>
            </button>

            <div class="donate-note">
              <h4><?php echo $currentLocale === 'id' ? 'Penting' : 'Important'; ?></h4>
              <p><?php echo $currentLocale === 'id' ? 'Setelah melakukan transfer, silakan kirim bukti transfer ke email kami di info.inabcru@gmail.com dengan subject "Donasi [Nama]" untuk pencatatan donasi.' : 'After making a transfer, please send proof of transfer to our email at info.inabcru@gmail.com with subject "Donation [Name]" for donation recording.'; ?></p>
            </div>
          </div>

          <div class="donate-tiers">
            <h2><?php echo t('donate.donationTiers.title', $currentLocale); ?></h2>
            
            <div class="tiers-grid">
              <div class="tier-card">
                <span class="tier-amount"><?php echo $currentLocale === 'id' ? 'Rp 100.000' : 'Rp 100,000'; ?></span>
                <p class="tier-impact"><?php echo t('donate.donationTiers.Rp100K.impact', $currentLocale); ?></p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier1')"><?php echo $currentLocale === 'id' ? 'Donasi Sekarang' : 'Donate Now'; ?></button>
              </div>
              
              <div class="tier-card popular">
                <span class="popular-badge"><?php echo $currentLocale === 'id' ? 'Populer' : 'Popular'; ?></span>
                <span class="tier-amount"><?php echo $currentLocale === 'id' ? 'Rp 500.000' : 'Rp 500,000'; ?></span>
                <p class="tier-impact"><?php echo t('donate.donationTiers.Rp500K.impact', $currentLocale); ?></p>
                <button class="btn btn-primary btn-sm" onclick="copyAccount('1234567890', 'tier2')"><?php echo $currentLocale === 'id' ? 'Donasi Sekarang' : 'Donate Now'; ?></button>
              </div>
              
              <div class="tier-card">
                <span class="tier-amount"><?php echo $currentLocale === 'id' ? 'Rp 1.000.000' : 'Rp 1,000,000'; ?></span>
                <p class="tier-impact"><?php echo t('donate.donationTiers.Rp1M.impact', $currentLocale); ?></p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier3')"><?php echo $currentLocale === 'id' ? 'Donasi Sekarang' : 'Donate Now'; ?></button>
              </div>
              
              <div class="tier-card">
                <span class="tier-amount"><?php echo $currentLocale === 'id' ? 'Rp 5.000.000+' : 'Rp 5,000,000+'; ?></span>
                <p class="tier-impact"><?php echo t('donate.donationTiers.Rp5M.impact', $currentLocale); ?></p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier4')"><?php echo $currentLocale === 'id' ? 'Donasi Sekarang' : 'Donate Now'; ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-padding-sm bg-surface-warm border-t border-border">
      <div class="container">
        <div class="mou-card">
          <div class="mou-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <h3><?php echo t('donate.institutional.title', $currentLocale); ?></h3>
          <p><?php echo t('donate.institutional.mouInfo', $currentLocale); ?></p>
          <a href="mailto:info.inabcru@gmail.com?subject=MoU%20Inquiry" class="contact-link"><?php echo t('donate.institutional.contactForMoU', $currentLocale); ?></a>
        </div>
      </div>
    </section>

    <section class="section-padding bg-primary text-white">
      <div class="container text-center">
        <blockquote class="cta-quote">"<?php echo t('donate.ctaQuote', $currentLocale); ?>"</blockquote>
        <button class="btn btn-secondary btn-lg" onclick="copyAccount('1234567890', 'cta')">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <?php echo t('donate.donateCta.button', $currentLocale); ?>
        </button>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/../includes/footer.php'; ?>

  <div id="toast" class="toast" style="display: none;">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span><?php echo $currentLocale === 'id' ? 'Nomor rekening berhasil disalin!' : 'Account number copied!'; ?></span>
  </div>

  <script>
    let toastTimeout;

    function copyAccount(account, source) {
      navigator.clipboard.writeText(account).then(() => {
        const toast = document.getElementById('toast');
        toast.style.display = 'flex';
        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
          toast.style.display = 'none';
        }, 2000);
      }).catch(err => {
        console.error('Failed to copy:', err);
        alert('<?php echo $currentLocale === 'id' ? 'Gagal menyalin nomor rekening' : 'Failed to copy account number'; ?>');
      });
    }
  </script>
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

.donate-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
}

.donate-info h2,
.donate-tiers h2 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 32px;
}

.bank-card {
  background: var(--color-surface-warm);
  border-radius: 16px;
  padding: 24px 32px;
  border: 1px solid var(--color-border);
  margin-bottom: 24px;
}

.bank-row {
  display: flex;
  justify-content: space-between;
  padding: 16px 0;
  border-bottom: 1px solid var(--color-border);
}

.bank-row:last-child {
  border-bottom: none;
}

.bank-label {
  color: var(--color-muted);
}

.bank-value {
  font-weight: 600;
}

.bank-account {
  font-family: monospace;
  font-size: 18px;
}

.copy-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.copy-btn .icon {
  width: 20px;
  height: 20px;
}

.donate-note {
  background: rgba(249, 115, 22, 0.05);
  border: 1px solid rgba(249, 115, 22, 0.2);
  border-radius: 16px;
  padding: 24px;
  margin-top: 24px;
}

.donate-note h4 {
  color: var(--color-cta);
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 8px;
}

.donate-note p {
  color: var(--color-muted);
  font-size: 14px;
  line-height: 1.6;
}

.tiers-grid {
  display: grid;
  gap: 16px;
}

.tier-card {
  background: var(--color-background);
  border-radius: 16px;
  padding: 24px;
  border: 1px solid var(--color-border);
  position: relative;
}

.tier-card.popular {
  border-color: var(--color-cta);
  box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.2);
}

.popular-badge {
  position: absolute;
  top: -12px;
  left: 24px;
  background: var(--color-cta);
  color: white;
  font-size: 12px;
  font-weight: 600;
  padding: 4px 12px;
  border-radius: 20px;
}

.tier-amount {
  display: block;
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: 8px;
}

.tier-impact {
  color: var(--color-muted);
  font-size: 14px;
  margin-bottom: 16px;
}

.tier-card .btn {
  width: 100%;
}

.mou-card {
  background: var(--color-background);
  border-radius: 16px;
  padding: 48px;
  border: 1px solid var(--color-border);
  text-align: center;
}

.mou-icon {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  background: rgba(43, 57, 132, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin: 0 auto 24px;
}

.mou-icon svg {
  width: 32px;
  height: 32px;
}

.mou-card h3 {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 12px;
}

.mou-card p {
  color: var(--color-muted);
  max-width: 480px;
  margin: 0 auto 20px;
  line-height: 1.6;
}

.contact-link {
  color: var(--color-primary);
  font-weight: 500;
}

.contact-link:hover {
  text-decoration: underline;
}

.cta-quote {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 32px;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.btn-secondary {
  background: transparent;
  color: white;
  border: 2px solid rgba(255,255,255,0.3);
}

.btn-secondary:hover {
  background: rgba(255,255,255,0.1);
}

@media (max-width: 768px) {
  .donate-grid {
    grid-template-columns: 1fr;
  }
}
</style>