<?php
// Start output buffering and session
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

// Include configuration file
require_once 'config.php';
// require_once './modules/auth/login.php';
// require_once './includes/index.php';

// Constants for system configuration
const _NGHIA = true;
const _MODULES = 'dashboard';
const _ACTION = 'index';

// Database configuration
const _HOST = 'localhost';
const _DB = 'crm-system';
const _USER = 'root';
const _PASS = '';
const _DRIVER = 'mysql';

// Debug mode
const _DEBUG = true;

// Setup host and path URLs dynamically
define('_HOST_URL', 'http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '/Learn-PHP/CRM-System');
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . DIRECTORY_SEPARATOR . 'templates');

// Debugging output (remove in production)
// if (_DEBUG) {
//   echo _HOST_URL . '<br>';
//   echo _PATH_URL . '<br>';
//   echo _PATH_URL_TEMPLATES . '<br>';
//   echo _HOST_URL_TEMPLATES . '<br>';
//   echo _MODULES . ' and ' . _ACTION;
// }
