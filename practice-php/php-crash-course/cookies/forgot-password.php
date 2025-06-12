<?php
session_start();

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// CSRF token
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
  // Validate CSRF token
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $error = "Invalid request";
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Vui lòng nhập email hợp lệ";
    } else {
      // In a real app, you would:
      // 1. Check if email exists in database
      // 2. Generate a password reset token
      // 3. Send email with reset link
      // 4. Store token in database with expiration

      // For demo purposes, we'll just show a message
      $message = "Nếu email tồn tại trong hệ thống, bạn sẽ nhận được liên kết đặt lại mật khẩu.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quên mật khẩu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="forgot-password.css">
</head>

<body>
  <div class="container">
    <div class="forgot-container mx-auto">
      <div class="forgot-header">
        <h2><i class="bi bi-key"></i> Quên mật khẩu</h2>
      </div>
      <div class="forgot-body">
        <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>
        <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <p>Vui lòng nhập địa chỉ email của bạn. Chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật
          khẩu.</p>

        <form method="POST" id="forgotForm">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
          <input type="hidden" name="reset" value="1">

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
              required autocomplete="email">
            <label for="email">Email</label>
          </div>

          <button type="submit" class="btn btn-reset w-100 text-white mb-3">
            <i class="bi bi-send"></i> Gửi yêu cầu
          </button>

          <div class="text-center">
            <a href="login.php" class="text-decoration-none">
              <i class="bi bi-arrow-left"></i> Quay lại đăng nhập
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
  <script>
  // Form submission protection
  let formSubmitted = false;
  document.getElementById('forgotForm').addEventListener('submit', function() {
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