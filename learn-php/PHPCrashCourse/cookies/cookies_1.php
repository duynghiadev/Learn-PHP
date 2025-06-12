<?php
session_start();

$valid_email = 'test@example.com';
$valid_password = '123456';

$email = '';
$remember = false;
$error = '';

// Đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  session_unset();
  session_destroy();
  setcookie('remember_email', '', time() - 3600); // xóa cookie
  header('Location: cookies_1.php');
  exit;
}

// Nếu đã đăng nhập, hiển thị chào mừng
if (isset($_SESSION['email'])) {
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Chào mừng</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background: #e0f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .welcome {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
  }

  .welcome h2 {
    color: #2c3e50;
    margin-bottom: 20px;
  }

  .welcome a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #e74c3c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .welcome a:hover {
    background-color: #c0392b;
  }
  </style>
</head>

<body>
  <div class="welcome">
    <h2>Chào, <?= htmlspecialchars($_SESSION['email']) ?>!</h2>
    <a href="?action=logout">Đăng xuất</a>
  </div>
</body>

</html>
<?php
  exit;
}


// Nếu có cookie lưu email
if (isset($_COOKIE['remember_email'])) {
  $email = $_COOKIE['remember_email'];
  $remember = true;
}

// Xử lý form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $remember = isset($_POST['remember']);

  if ($email === $valid_email && $password === $valid_password) {
    $_SESSION['email'] = $email;

    if ($remember) {
      setcookie('remember_email', $email, time() + 30 * 24 * 3600); // 30 ngày
    } else {
      setcookie('remember_email', '', time() - 3600); // xóa nếu không chọn
    }

    header('Location: cookies_1.php');
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
  <title>Đăng nhập</title>
  <style>
  body {
    font-family: Arial;
    background: #f0f0f0;
    padding: 40px;
  }

  .container {
    max-width: 400px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  input[type=text],
  input[type=password] {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
  }

  input[type=submit] {
    padding: 10px 20px;
    background: #3498db;
    color: white;
    border: none;
  }

  label {
    display: block;
    margin-top: 10px;
  }

  .error {
    color: red;
    margin-top: 10px;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Đăng nhập</h2>
    <?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <label>Email:</label>
      <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" required>

      <label>Mật khẩu:</label>
      <input type="password" name="password" required>

      <label>
        <input type="checkbox" name="remember" <?= $remember ? 'checked' : '' ?>>
        Ghi nhớ đăng nhập
      </label>

      <input type="submit" value="Đăng nhập">
    </form>
  </div>
</body>

</html>