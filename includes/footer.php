<?php
$currentYear = date('Y');
?>
<footer class="footer bg-dark text-white">
  <div class="container">
    <div class="footer-content">
      <div class="footer-brand">
        <a href="<?php echo BASE_URL; ?>/" class="footer-logo">
          <span class="logo-icon">I</span>
          <span class="logo-text">InaBCRU</span>
        </a>
        <p class="footer-tagline"><?php echo $messages['footer']['tagline']; ?></p>
      </div>

      <div class="footer-links">
        <h4><?php echo $messages['footer']['quickLinks']; ?></h4>
        <ul>
          <li><a href="<?php echo BASE_URL; ?>/"><?php echo $messages['nav']['home']; ?></a></li>
          <li><a href="<?php echo BASE_URL; ?>/about"><?php echo $messages['nav']['about']; ?></a></li>
          <li><a href="<?php echo BASE_URL; ?>/team"><?php echo $messages['nav']['team']; ?></a></li>
          <li><a href="<?php echo BASE_URL; ?>/publications"><?php echo $messages['nav']['publications']; ?></a></li>
          <li><a href="<?php echo BASE_URL; ?>/donate"><?php echo $messages['nav']['donate']; ?></a></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h4><?php echo $messages['footer']['contactInfo']; ?></h4>
        <ul>
          <li><?php echo $messages['footer']['email']; ?>: info.inabcru@gmail.com</li>
          <li><?php echo $messages['footer']['founded']; ?>: February 5, 2025</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo $currentYear; ?> Indonesia Bat Conservation Research Union</p>
      <p class="legal-id"><?php echo $messages['footer']['legalId']; ?></p>
    </div>
  </div>
</footer>

<style>
.footer {
  padding: 64px 0 32px;
}

.footer-content {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
  gap: 48px;
  margin-bottom: 48px;
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 16px;
}

.footer-logo .logo-icon {
  width: 40px;
  height: 40px;
  background: var(--color-primary);
  color: white;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 18px;
}

.footer-logo .logo-text {
  font-family: 'Playfair Display', serif;
  font-weight: 600;
  font-size: 20px;
}

.footer-tagline {
  color: rgba(255,255,255,0.6);
  font-size: 14px;
  line-height: 1.6;
  max-width: 280px;
}

.footer-links h4,
.footer-contact h4 {
  font-family: 'Playfair Display', serif;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 16px;
}

.footer-links ul,
.footer-contact ul {
  list-style: none;
  padding: 0;
}

.footer-links li,
.footer-contact li {
  margin-bottom: 10px;
}

.footer-links a {
  color: rgba(255,255,255,0.6);
  font-size: 14px;
  transition: color 0.2s;
}

.footer-links a:hover {
  color: white;
}

.footer-contact li {
  color: rgba(255,255,255,0.6);
  font-size: 14px;
}

.footer-bottom {
  padding-top: 32px;
  border-top: 1px solid rgba(255,255,255,0.1);
  text-align: center;
}

.footer-bottom p {
  font-size: 13px;
  color: rgba(255,255,255,0.4);
  margin-bottom: 8px;
}

.legal-id {
  font-size: 12px !important;
}

@media (max-width: 768px) {
  .footer-content {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}
</style>