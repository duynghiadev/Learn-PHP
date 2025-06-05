<?php

declare(strict_types=1);

require_once 'config.php';
require_once 'auth.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $user = authenticate($email, $password, $pdo);
  if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $success = "Login successful! Redirecting to CRUD page.";
    header("Refresh:2; url=index.php");
  } else {
    $errors[] = "Invalid email or password";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4a6de5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #3a55b8;
    }

    .error {
      color: #e63946;
      font-size: 12px;
      margin-top: 5px;
    }

    .success {
      color: #2ecc71;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Login</h2>
    <?php if (!empty($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($success): ?>
      <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <p><a href="register.php">Don't have an account? Register</a></p>
  </div>
</body>

</html>