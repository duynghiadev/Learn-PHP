<?php
const _HIENU = true;

const _MODULES = 'dashboard';
const _ACTION = 'index';

// Database configuration
const _HOST = 'localhost';
const _DB = 'crm-system'; // Verify this matches your actual database name
const _USER = 'root';
const _PASS = '';
const _DRIVER = 'mysql';

// Debug mode
const _DEBUG = true;

// Setup host and paths dynamically
define('_HOST_URL', 'http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . dirname($_SERVER['SCRIPT_NAME']));
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');

// Setup paths
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . DIRECTORY_SEPARATOR . 'templates');
