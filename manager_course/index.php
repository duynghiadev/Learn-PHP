<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start(); // 
ob_start(); //header, cookie


require_once 'config.php'; 

require_once './includes/connect.php';
require_once './includes/database.php';

$data = [
    'fullname' => 'Hiếu Nguyễn 1',
    'email' => 'hieu@gmail.com',
    'phone' => '098765433'
];

$condition = 'id = 1';

insert('users',$data);

$rel = lastID();

echo $rel;





$module = _MODULES;
$action = _ACTION;

if(!empty($_GET['module'])){
    $module = $_GET['module'];
}

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$path = 'modules/' . $module . '/' . $action . '.php';

if(!empty($path)){
    if(file_exists($path)){
        require_once $path;
    }else {
        require_once './modules/errors/404.php';
    }
}else {
    require_once './modules/errors/500.php';
}