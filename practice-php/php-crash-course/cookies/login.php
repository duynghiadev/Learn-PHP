<?php
session_start();

// Configuration
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_ATTEMPT_TIMEOUT', 15 * 60); // 15 minutes
define('SESSION_TIMEOUT', 30 * 60); // 30 minutes
define('REMEMBER_ME_EXPIRE', 30 * 24 * 3600); // 30 days

// Database simulation (in a real app, use PDO/MySQLi)
$users = [
  'test@gmail.com' => [
    'password_hash' => password_hash('123456', PASSWORD_BCRYPT),
    'failed_attempts' => 0,
    'last_attempt' => 0,
    'name' => 'Nguyễn Văn A'
  ]
];

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Session regeneration
if (empty($_SESSION['initiated'])) {
  session_regenerate_id();
  $_SESSION['initiated'] = true;
}

// Session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > SESSION_TIMEOUT)) {
  session_unset();
  session_destroy();
  setcookie('remember_token', '', time() - 3600, '/', '', true, true);
  header('Location: login.php');
  exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

// CSRF token
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  session_unset();
  session_destroy();
  setcookie('remember_token', '', time() - 3600, '/', '', true, true);
  header('Location: login.php');
  exit;
}

// Check if logged in
if (isset($_SESSION['email'])) {
  header('Location: dashboard.php');
  exit;
}

// Check remember token
if (isset($_COOKIE['remember_token'])) {
  // In real app, verify token against database
  $_SESSION['email'] = 'test@gmail.com';
  header('Location: dashboard.php');
  exit;
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';
  $remember = isset($_POST['remember']);

  // Validate CSRF
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $error = "Invalid request";
  }
  // Validate email
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  }
  // Check user exists
  elseif (!isset($users[$email])) {
    $error = "Invalid email or password";
  } else {
    $user = $users[$email];

    // Check login attempts
    if (
      $user['failed_attempts'] >= MAX_LOGIN_ATTEMPTS &&
      (time() - $user['last_attempt']) < LOGIN_ATTEMPT_TIMEOUT
    ) {
      $remaining = ceil((LOGIN_ATTEMPT_TIMEOUT - (time() - $user['last_attempt'])) / 60);
      $error = "Too many attempts. Try again in $remaining minutes.";
    }
    // Verify password
    elseif (password_verify($password, $user['password_hash'])) {
      // Login success
      $_SESSION['email'] = $email;
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
      $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

      // Reset attempts
      $users[$email]['failed_attempts'] = 0;

      // Remember me
      if ($remember) {
        $token = bin2hex(random_bytes(32));
        // In real app, store token in database
        setcookie('remember_token', $token, time() + REMEMBER_ME_EXPIRE, '/', '', true, true);
      }

      session_regenerate_id(true);
      header('Location: dashboard.php');
      exit;
    } else {
      // Login failed
      $users[$email]['failed_attempts']++;
      $users[$email]['last_attempt'] = time();
      $error = "Invalid email or password";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập hệ thống</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <div class="container">
    <div class="login-container mx-auto">
      <div class="login-header">
        <h2><i class="bi bi-shield-lock"></i> Đăng nhập hệ thống</h2>
      </div>
      <div class="login-body">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <form method="POST" id="loginForm">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
          <input type="hidden" name="login" value="1">

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email"
              value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '' ?>"
              placeholder="Email" required autocomplete="username">
            <label for="email">Email</label>
          </div>

          <div class="form-floating mb-3 position-relative">
            <input type="password" class="form-control" id="password" name="password"
              placeholder="Mật khẩu" required autocomplete="current-password">
            <label for="password">Mật khẩu</label>
            <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
          </div>

          <button type="submit" class="btn btn-login w-100 text-white mb-3">
            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
          </button>

          <div class="text-center">
            <a href="forgot-password.php" class="text-decoration-none">Quên mật khẩu?</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
  <script>
  // Toggle password visibility
  document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
  });

  // Form submission protection
  let formSubmitted = false;
  document.getElementById('loginForm').addEventListener('submit', function() {
    if (formSubmitted) {
      return false;
    }
    formSubmitted = true;
    this.querySelector('button[type="submit"]').disabled = true;
    this.querySelector('button[type="submit"]').innerHTML =
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...';
  });
  </script>
</body>

</html>