<?php 
session_start();

// Khởi tạo session
$_SESSION['username'] = 'Hienu';
$_SESSION['user'] = 'Marketing';
$_SESSION['login'] = 'Vũ trụ marketing';

unset($_SESSION['username']);

session_destroy();

echo '<pre>';
print_r($_SESSION['username']);
echo '</pre>';

$_SESSION['user'] = 'Học lập trình PHP';

echo '<pre>';
print_r($_SESSION['user']);
echo '</pre>';

echo '<pre>';
print_r($_SESSION['login']);
echo '</pre>';

