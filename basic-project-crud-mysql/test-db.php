<?php

$host = 'localhost';
$dbname = 'crud_app';
$user_db = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $user_db, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connection successful";
} catch (\Throwable $ex) {
  echo "Connection failed: " . $ex->getMessage();
}
