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

$module = _MODULES;
$action = _ACTION;

if (!empty($_GET['module'])) {
    $module = $_GET['module'];
}

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Adjust path to point to templates/layout for auth-related files
if ($module === 'auth') {
    $path = 'templates/layout/' . $action . '.php';
} else {
    $path = 'modules/' . $module . '/' . $action . '.php';
}

if (!empty($path) && file_exists($path)) {
    require_once $path;
} else {
    require_once 'modules/errors/404.php';
}

ob_end_flush();
