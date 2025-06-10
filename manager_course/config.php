<?php
const _HIENU = true;

const _MODULES = 'dashboard';
const _ACTION = 'index';

// Khai báo database
const _HOST = 'localhost';
const _DB = 'crm-system';
const _USER = 'root';
const _PASS = '';
const _DRIVER = 'mysql';

// debug error
const _DEBUG = true;

// thiết lập host
define('_HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Learn-PHP/manager_course');
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');

// thiết lập path
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . '/templates');
