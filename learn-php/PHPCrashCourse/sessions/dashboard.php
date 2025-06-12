<?php
session_start();
$loggedIn = isset($_SESSION['email']);
$email = $loggedIn ? $_SESSION['email'] : null;
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
    background: #f0f2f5;
    color: #333;
  }

  .container {
    max-width: 700px;
    margin: 60px auto;
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  h1 {
    color: #007BFF;
    margin-bottom: 20px;
  }

  p {
    font-size: 18px;
    margin-bottom: 30px;
  }

  .info {
    background-color: #e7f1ff;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: bold;
  }

  a.button {
    display: inline-block;
    padding: 12px 20px;
    text-decoration: none;
    color: white;
    background-color: #007BFF;
    border-radius: 6px;
    transition: background-color 0.3s ease;
  }

  a.button:hover {
    background-color: #0056b3;
  }

  .guest-message {
    color: #555;
    font-style: italic;
  }
  </style>
</head>

<body>
  <div class="container">
    <h1>Trang Quản Trị (Dashboard)</h1>

    <?php if ($loggedIn): ?>
    <p class="info">Xin chào, <?= htmlspecialchars($email) ?>!</p>
    <p>Chào mừng bạn đến với hệ thống quản lý.</p>
    <a class="button" href="./logout.php">Đăng xuất</a>
    <?php else: ?>
    <p class="guest-message">Bạn chưa đăng nhập.</p>
    <a class="button" href="./sessions.php">Quay lại trang đăng nhập</a>
    <?php endif; ?>
  </div>
</body>

</html>