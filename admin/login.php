<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

checkLoginToken();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = postApi('/auth/login', ['email' => $email, 'password' => $password]);

    if ($result && isset($result['data']['token'])) {
        setcookie('auth_token', $result['data']['token'], time() + 86400, '/');
        header('Location: ' . BASE_URL . '/admin/dashboard');
        exit;
    } else {
        $error = $result['message'] ?? 'Login failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | InaBCRU Admin</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/admin/assets/css/admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f3f4f6;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
    }

    .login-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
    }

    .login-header {
      text-align: center;
      margin-bottom: 32px;
    }

    .login-logo {
      width: 64px;
      height: 64px;
      background: #2B3984;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }

    .login-logo-text {
      color: white;
      font-size: 28px;
      font-weight: 700;
      font-family: 'Playfair Display', serif;
    }

    .login-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 24px;
      font-weight: 600;
      color: #0F1117;
      margin-bottom: 8px;
    }

    .login-header p {
      color: #6B7080;
      font-size: 14px;
    }

    .error-message {
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 12px;
      padding: 14px 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #dc2626;
      font-size: 14px;
      margin-bottom: 24px;
    }

    .error-message svg {
      flex-shrink: 0;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-label {
      font-size: 14px;
      font-weight: 500;
      color: #374151;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      pointer-events: none;
    }

    .input-wrapper input {
      width: 100%;
      padding: 14px 16px 14px 48px;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      font-size: 15px;
      font-family: 'Inter', sans-serif;
      transition: all 0.2s;
      background: white;
    }

    .input-wrapper input:focus {
      outline: none;
      border-color: #2B3984;
      box-shadow: 0 0 0 3px rgba(43, 57, 132, 0.1);
    }

    .input-wrapper input::placeholder {
      color: #9ca3af;
    }

    .btn-login {
      width: 100%;
      padding: 14px 16px;
      background: #2B3984;
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: background 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-login:hover {
      background: #1e2a5c;
    }

    .btn-login:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }

    .btn-login .spinner {
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .login-footer {
      text-align: center;
      font-size: 12px;
      color: #9ca3af;
      margin-top: 24px;
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-header">
        <div class="login-logo">
          <span class="login-logo-text">I</span>
        </div>
        <h1>InaBCRU Admin</h1>
        <p>Sign in to access the admin panel</p>
      </div>

      <?php if ($error): ?>
        <div class="error-message">
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="login-form">
        <div class="form-group">
          <label class="form-label" for="email">Email / Username</label>
          <div class="input-wrapper">
            <svg class="input-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <input type="text" id="email" name="email" placeholder="Enter email or username" required autocomplete="username">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <div class="input-wrapper">
            <svg class="input-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
          </div>
        </div>

        <button type="submit" class="btn-login" id="loginBtn">
          <span class="btn-text">Sign In</span>
          <span class="btn-loader" style="display: none;">
            <svg class="spinner" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="31.4 31.4"/>
            </svg>
          </span>
        </button>
      </form>

      <p class="login-footer">&copy; 2025 Indonesia Bat Conservation Research Union</p>
    </div>
  </div>

  <script>
    const form = document.querySelector('.login-form');
    const btn = document.getElementById('loginBtn');
    const btnText = btn.querySelector('.btn-text');
    const btnLoader = btn.querySelector('.btn-loader');

    form.addEventListener('submit', function() {
      btnText.style.display = 'none';
      btnLoader.style.display = 'inline-flex';
      btn.disabled = true;
    });
  </script>
</body>
</html>