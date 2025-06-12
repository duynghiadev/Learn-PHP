<?php
session_start();
if (isset($_POST['submit'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = $_POST['password'];

  if ($email === 'test@gmail.com' && $password === '123456') {
    $_SESSION['email'] = $email;
    header('Location: ./dashboard.php');
    exit;
  } else {
    $error = "Sai email hoặc mật khẩu!";
  }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>
  <style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background: #f0f4f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .login-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }

  h1 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 6px;
    color: #333;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  input[type="submit"] {
    width: 100%;
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }

  .error {
    color: red;
    text-align: center;
    margin-bottom: 15px;
  }
  </style>
</head>

<body>
  <div class="login-container">
    <h1>Đăng nhập</h1>
    <?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Nhập email...">
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" placeholder="Nhập mật khẩu...">
      </div>
      <input type="submit" name="submit" value="Đăng nhập">
    </form>
  </div>
</body>

</html>