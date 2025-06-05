<?php

declare(strict_types=1);

session_start();

define('DB_HOST', '127.0.0.1'); // Use 127.0.0.1 to force TCP
define('DB_PORT', 3307); // Specify the port
define('DB_USER', 'root');
define('DB_PASS', 'duynghia123');
define('DB_NAME', 'crud_app');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error . " (Host: " . DB_HOST . ":" . DB_PORT . ", User: " . DB_USER . ")");
}

echo "Connected successfully! Host: " . DB_HOST . ":" . DB_PORT . ", Database: " . DB_NAME;

function isAuthenticated(): bool
{
  return isset($_SESSION['user_id']);
}
