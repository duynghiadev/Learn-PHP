<?php
// register.php
require_once __DIR__ . '/helpers/session.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';

safe_session_start();
$auth = new Auth();
if ($auth->isLoggedIn()) {
  header("Location: index.php");
  exit;
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="./css/register.css">
</head>

<body>
  <div class="container">
    <h1>Register</h1>
    <?php if (!empty($errors)): foreach ($errors as $error): ?><p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endforeach;
    endif; ?>
    <form action="process.php" method="POST" class="form-group">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
      </div>
      <button type="submit" name="action" value="register">Register</button>
    </form>
    <div class="login-link">
      <a href="login.php">Already have an account? Login</a>
    </div>
  </div>
</body>

</html>