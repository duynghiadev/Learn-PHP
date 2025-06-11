<?php
// File: signup.php
declare(strict_types=1);

require_once 'functions.php';

session_start();

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if (strlen($username) < 3) {
    header('Content-Type: application/json', true, 400);
    echo json_encode(['success' => false, 'message' => 'Username must be at least 3 characters']);
    exit;
  } elseif (strlen($password) < 6) {
    header('Content-Type: application/json', true, 400);
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
    exit;
  } else {
    if (createUser($username, $password)) {
      setcookie('user_data', json_encode(['username' => $username]), time() + (7 * 24 * 3600), '/');
      header('Content-Type: application/json');
      echo json_encode(['success' => true, 'message' => 'Sign up successful! Please login.']);
      exit;
    } else {
      header('Content-Type: application/json', true, 400);
      echo json_encode(['success' => false, 'message' => 'Username already exists']);
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles.css?v=3">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">
</head>

<body>
  <div class="container">
    <h1>Sign Up</h1>
    <?php if (isset($errors['username'])): ?>
      <p class="error"><?= htmlspecialchars($errors['username']) ?></p>
    <?php endif; ?>
    <?php if (isset($errors['password'])): ?>
      <p class="error"><?= htmlspecialchars($errors['password']) ?></p>
    <?php endif; ?>

    <form action="signup.php" method="POST" class="form-group" id="signup-form">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
  <script>
    // Toast notifications
    function showToast(message, type = 'info') {
      Toastify({
        text: message,
        duration: 2000,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'error' ? "#dc2626" : "#22c55e",
        className: type
      }).showToast();
    }

    // Load user data from local storage
    window.addEventListener('load', () => {
      const userData = document.getElementById('localStorage').getItem('userData');
      if (userData) {
        const {
          username
        } = JSON.parse(userData);
        document.querySelector('#username').value = username;
      }
    });

    // Form submission handling
    document.querySelector('#signup-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);

      try {
        const response = await fetch('signup.php', {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          }
        });

        const result = await response.json();
        if (response.ok && result.success) {
          const username = formData.get('username');
          localStorage.setItem('userData', JSON.stringify({
            username
          }));
          showToast(result.message || 'Sign up successful! Please login.', 'success');
          setTimeout(() => window.location.href = 'login.php', 1000);
        } else {
          showToast(result.message || 'Sign up failed!', 'error');
        }
      } catch (error) {
        showToast('Network error occurred!', 'error');
      }
    });
  </script>
</body>

</html>