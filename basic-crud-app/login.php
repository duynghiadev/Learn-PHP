<?php
// File: login.php
declare(strict_types=1);

require_once 'functions.php';

session_start();

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  $users = $_SESSION['users'] ?? [];
  if (!isset($users[$username])) {
    header('Content-Type: application/json', true, 401);
    echo json_encode(['success' => false, 'message' => 'Account not found']);
    exit;
  }

  if (validateUser($username, $password)) {
    $token = generateUserToken($username);
    setcookie('user_token', $token, time() + (7 * 24 * 3600), '/');
    setcookie('user_data', json_encode(['username' => $username]), time() + (7 * 24 * 3600), '/');
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Login successful']);
    exit;
  } else {
    header('Content-Type: application/json', true, 401);
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css?v=3">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">
</head>

<body>
  <div class="container">
    <h1>Login</h1>
    <?php if (isset($errors['login'])): ?>
      <p class="error"><?= htmlspecialchars($errors['login']) ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST" class="form-group" id="login-form">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
  <script>
    // Toast notifications
    function showToast(message, type = 'info') {
      Toastify({
        text: message,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'error' ? "#dc2626" : "#22c55e",
        className: type
      }).showToast();
    }

    // Load user data from local storage
    window.addEventListener('load', () => {
      const userData = localStorage.getItem('userData');
      if (userData) {
        const {
          username
        } = JSON.parse(userData);
        document.querySelector('#username').value = username;
      }
    });

    // Form submission handling
    document.querySelector('#login-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);

      try {
        const response = await fetch('login.php', {
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
          localStorage.setItem('userToken', '<?php echo isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : ''; ?>');
          showToast(result.message || 'Login successful!', 'success');
          setTimeout(() => window.location.href = 'index.php', 1000);
        } else {
          showToast(result.message || 'Login failed!', 'error');
        }
      } catch (error) {
        showToast('Network error occurred!', 'error');
      }
    });
  </script>
</body>

</html>