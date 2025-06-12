<?php
// Gọi từ URL: ?action=set / ?action=delete / (mặc định là đọc)
$cookie_name = 'name';
$cookie_value = 'Hoang';
$cookie_duration = time() + 86400; // 1 ngày

$action = $_GET['action'] ?? '';

$message = '';

if ($action === 'set') {
    setcookie($cookie_name, $cookie_value, $cookie_duration);
    $message = "✅ Cookie <strong>$cookie_name</strong> đã được tạo và lưu trong trình duyệt!";
} elseif ($action === 'delete') {
    setcookie($cookie_name, '', time() - 3600);
    $message = "❌ Cookie <strong>$cookie_name</strong> đã bị xóa!";
} else {
    if (isset($_COOKIE[$cookie_name])) {
        $message = "🔁 Cookie <strong>$cookie_name</strong> tồn tại. Giá trị: <strong>{$_COOKIE[$cookie_name]}</strong>";
    } else {
        $message = "⚠️ Không tìm thấy cookie <strong>$cookie_name</strong>. Bạn có thể set lại bên dưới.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>PHP Cookies Demo</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 40px;
    background-color: #f0f2f5;
  }

  .box {
    padding: 20px;
    background: white;
    border-radius: 8px;
    max-width: 500px;
    margin: auto;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  }

  h2 {
    margin-top: 0;
    color: #2c3e50;
  }

  a.button {
    display: inline-block;
    padding: 10px 14px;
    margin: 10px 5px 0 0;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 4px;
  }

  a.button:hover {
    background-color: #2980b9;
  }

  .message {
    margin: 10px 0;
    padding: 10px;
    background-color: #ecf0f1;
    border-left: 5px solid #3498db;
  }
  </style>
</head>

<body>
  <div class="box">
    <h2>Cookie Demo in PHP</h2>
    <div class="message"><?= $message ?></div>
    <a class="button" href="?action=set">Set Cookie</a>
    <a class="button" href="?action=delete">Delete Cookie</a>
    <a class="button" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">Reload Page</a>
  </div>
</body>

</html>