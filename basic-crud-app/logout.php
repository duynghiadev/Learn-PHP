<?php
// File: logout.php
declare(strict_types=1);

session_start();

// Clear cookies
setcookie('user_token', '', time() - 3600, '/');
setcookie('user_data', '', time() - 3600, '/');

// Clear session
$_SESSION = [];
session_destroy();

header('Location: login.php');
exit;
