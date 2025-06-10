<?php
const _CODE = true;
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

// Setup host and paths
define('_HOST_URL', 'http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '/Learn-PHP/hienu_php/manager_users');
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . DIRECTORY_SEPARATOR . 'templates');
