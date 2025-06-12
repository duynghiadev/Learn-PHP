<?php
echo "<h2>Superglobals in PHP - GET and POST Demo</h2>";

$email = '';
$password = '';

// --- Xử lý GET ---
if (isset($_GET['source'])) {
  $source = htmlspecialchars($_GET['source']);
  echo "<p><strong>GET param:</strong> source = $source</p>";
}

// --- Xử lý POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = htmlspecialchars($_POST['password'] ?? '');

  echo "<h4>Submitted via POST:</h4>";
  echo "Email: <strong>$email</strong><br>";
  echo "Password: <strong>$password</strong><br>";

  // TODO: Gửi dữ liệu đến CSDL hoặc xử lý đăng nhập
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GET & POST Form</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 40px;
    background-color: #f5f6fa;
  }

  form {
    background: #ffffff;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #2980b9;
  }

  h3 {
    margin-bottom: 10px;
  }

  .link {
    margin-top: 20px;
  }
  </style>
</head>

<body>

  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?source=form" method="POST">
    <h3>Login to Your Account</h3>
    <label for="email">Email:</label>
    <input type="text" name="email" placeholder="Enter your email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required>

    <input type="submit" value="Submit">
  </form>

  <div class="link">
    <p>Thử truyền tham số GET: <br>
      <a
        href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?source=homepage">?source=homepage</a><br>
      <a
        href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?source=login_page">?source=login_page</a>
    </p>
  </div>

</body>

</html>