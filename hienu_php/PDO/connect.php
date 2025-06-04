<?php
/*
try{
$__HOST = '127.0.0.1';
$__DB = 'webcompany';
$__USER = 'root';
$__PASS = 'mysql';
$options = [
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Set utf8
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Tạo thông báo
ra ngoại lệ khi gặp lỗi
];
$con=new PDO('mysql:dbname='.$__DB.';host='.$__HOST, $__USER,
$__PASS, $options);
}catch (Exception $e){
$err = $e->getMessage();
die()
}
mysqli
*/


// Thông tin kết nối
const _HOST = 'localhost';
const _DB = 'hienu_123';
const _USER = 'root';
const _PASS = '';

try {
    if (class_exists('PDO')) {

        $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Tạo thông báo ra ngoại lệ khi gặp lỗi
        ];

        $conn = new PDO($dsn, _USER, _PASS, $options);
        // if($conn){
        //     echo ' Kết nối thành công ';
        // }
    }
} catch (Exception $exception) {
    echo '<div style="color:red; padding: 5px 15px;border: 1px solid red;">';
    echo $exception->getMessage() . '<br>';
    echo '</div>';
    die();
}
