<?php

declare(strict_types=1);

session_start();

define('DB_HOST', '127.0.0.1'); // Use 127.0.0.1 to force TCP connection
define('DB_PORT', '3307');
define('DB_USER', 'root');
define('DB_PASS', 'duynghia123');
define('DB_NAME', 'crud_app');

try {
  $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
  $pdo = new PDO($dsn, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  echo "Connection successful!"; // Debug output
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage() . " (DSN: $dsn)");
}

function isAuthenticated(): bool
{
  return isset($_SESSION['user_id']);
}
