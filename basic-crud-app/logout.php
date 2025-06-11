<?php
// File: logout.php
declare(strict_types=1);

session_start();

// Xóa user_token cookie
if (isset($_COOKIE['user_token'])) {
  unset($_SESSION['tokens'][$_COOKIE['user_token']]);
  setcookie('user_token', '', time() - 3600, '/');
}

// Không xóa user_data cookie để giữ thông tin username
// Xóa session data trừ users
unset($_SESSION['dataStore']);
unset($_SESSION['tokens']);

// Xóa local storage userToken và crudData, giữ userData
echo '<script>
    localStorage.removeItem("userToken");
    window.location.href = "login.php";
</script>';

session_destroy();
