<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dukung Kami | InaBCRU</title>
  <meta name="description" content="Bantu kami melindungi kelelawar Indonesia melalui donasi">
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
        <p class="hero-label">Dukung Kami</p>
        <h1>Dukung Kami</h1>
        <p class="hero-subtitle">Bantu kami melindungi kelelawar Indonesia</p>
      </div>
    </section>

    <section class="section-padding bg-background">
      <div class="container">
        <div class="donate-grid">
          <div class="donate-info">
            <h2>Transfer Bank</h2>
            
            <div class="bank-card">
              <div class="bank-row">
                <span class="bank-label">Nama Bank</span>
                <span class="bank-value">Bank Central Asia (BCA)</span>
              </div>
              <div class="bank-row">
                <span class="bank-label">Nomor Rekening</span>
                <span class="bank-value bank-account">1234567890</span>
              </div>
              <div class="bank-row">
                <span class="bank-label">Nama Penerima</span>
                <span class="bank-value">InaBCRU</span>
              </div>
            </div>

            <button class="btn btn-primary copy-btn" onclick="copyAccount('1234567890', 'bank')">
              <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
              </svg>
              Salin Nomor Rekening
            </button>

            <div class="donate-note">
              <h4>Penting</h4>
              <p>Setelah melakukan transfer, silakan kirim bukti transfer ke email kami di info.inabcru@gmail.com dengan subject "Donasi [Nama]" untuk pencatatan donasi.</p>
            </div>
          </div>

          <div class="donate-tiers">
            <h2>Paket Donasi</h2>
            
            <div class="tiers-grid">
              <div class="tier-card">
                <span class="tier-amount">Rp 100.000</span>
                <p class="tier-impact">Mendukung biaya bahan edukasi untuk satu sekolah</p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier1')">Donasi Sekarang</button>
              </div>
              
              <div class="tier-card popular">
                <span class="popular-badge">Populer</span>
                <span class="tier-amount">Rp 500.000</span>
                <p class="tier-impact">Mendukung satu sesi pelatihan lapangan</p>
                <button class="btn btn-primary btn-sm" onclick="copyAccount('1234567890', 'tier2')">Donasi Sekarang</button>
              </div>
              
              <div class="tier-card">
                <span class="tier-amount">Rp 1.000.000</span>
                <p class="tier-impact">Mendukung penelitian satu lokasi survei</p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier3')">Donasi Sekarang</button>
              </div>
              
              <div class="tier-card">
                <span class="tier-amount">Rp 5.000.000+</span>
                <p class="tier-impact">Mendukung program konservasi terintegrasi</p>
                <button class="btn btn-outline btn-sm" onclick="copyAccount('1234567890', 'tier4')">Donasi Sekarang</button>
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
          <h3>Donor Institusi</h3>
          <p>Kami menyediakan MoU untuk donor institusi dengan laporan transparansi lengkap.</p>
          <a href="mailto:info.inabcru@gmail.com?subject=MoU%20Inquiry" class="contact-link">Hubungi kami untuk informasi MoU</a>
        </div>
      </div>
    </section>

    <section class="section-padding bg-primary text-white">
      <div class="container text-center">
        <blockquote class="cta-quote">"Kelelawar melindungi hutan, pangan, dan kesehatan kita — bantu kami melindungi mereka."</blockquote>
        <button class="btn btn-secondary btn-lg" onclick="copyAccount('1234567890', 'cta')">
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          Donasi Sekarang
        </button>
      </div>
    </section>
  </main>

  <?php require_once __DIR__ . '/../includes/footer.php'; ?>

  <div id="toast" class="toast" style="display: none;">
    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span>Nomor rekening berhasil disalin!</span>
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
        alert('Gagal menyalin nomor rekening');
      });
    }
  </script>
</body>
</html>

<style>
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