<?php
const _NGHIA = true;

// khai bao database
const _HOST = 'localhost';
const _DB = 'crm_system';
const _USER = 'root';
const _PASS = '';
const _DRIVER = 'mysql';


// debug error
const _DEBUG = true;

// setup host
define('_HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Learn-PHP/CRM-System');
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');
// setup path
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . '/templates');

echo _HOST_URL . '<br>';
echo _PATH_URL . '<br>';
echo _PATH_URL_TEMPLATES . '<br>';
echo _HOST_URL_TEMPLATES . '<br>';
