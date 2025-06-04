<?php 
// Bật thông báo về lỗi 
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);

$bien1 = 'hienu 2022';

if(isset($bien1)){
    echo $bien1;
}


//  Empty
echo '<br>';

$str = 1;
if(!empty($str)){
    echo $str;
}
else {
    echo 'Không hợp lệ';
}
