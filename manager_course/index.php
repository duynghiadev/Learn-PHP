<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
ob_start();

// Enable error reporting for debugging
if (defined('_DEBUG') && _DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

// Test database insertion
$data = [
    'fullname' => 'Hiếu Nguyễn 1',
    'email' => 'hieu@gmail.com',
    'phone' => '098765433'
];
$condition = 'id = 1';

if (insert('users', $data)) {
    echo 'Insert successful!<br>';
    $rel = lastID();
    echo 'Last ID: ' . $rel . '<br>';
} else {
    echo 'Insert failed!<br>';
}

$module = _MODULES;
$action = _ACTION;

if (!empty($_GET['module'])) {
    $module = $_GET['module'];
}

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$path = 'modules/' . $module . '/' . $action . '.php';

if (!empty($path)) {
    if (file_exists($path)) {
        require_once $path;
    } else {
        require_once './modules/errors/404.php';
    }
} else {
    require_once './modules/errors/500.php';
}

ob_end_flush();
