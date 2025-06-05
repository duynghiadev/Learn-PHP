<?php
// register.php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';

session_start();
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
  <style>
    body {
      background-color: #f4f7fa;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
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
      background: #4a6de5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #3a55b8;
    }

    .error {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }

    .login-link {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Register</h1>
    <?php if (!empty($errors)): foreach ($errors as $error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endforeach;
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

</html><?php
        // register.php
        require_once __DIR__ . '/config/db.php';
        require_once __DIR__ . '/includes/auth.php';

        session_start();
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
  <style>
    body {
      background-color: #f4f7fa;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
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
      background: #4a6de5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #3a55b8;
    }

    .error {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }

    .login-link {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Register</h1>
    <?php if (!empty($errors)): foreach ($errors as $error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endforeach;
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