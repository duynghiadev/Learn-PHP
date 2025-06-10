<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
ob_start(); // header, cookie

require_once 'config.php';
require_once './modules/auth/login.php';
require_once './includes/index.php';
