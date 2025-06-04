<?php 
// Khai báo mảng
$arr = array('HTML','JS','PHP');

$arr2 = ['address1' => 'HTML','address2' => 'JS','address3' => 'PHP'] ;

$arrEmpty = [];

// Thêm phân từ vào mảng

$arr2['address4'] = 'NodeJS';
// $arr2[] = 'C';
// $arr2[] = 'C++';

array_push($arr,'NodeJs','C','C++','C#');

// Sửa mảng
$arr[0] = 'HTMLNEW';
$arr2['address2'] = 'Javascript';

// Xoá phan tử
unset($arr2['address1']);

// in mảng
echo '<pre>';
print_r($arr2);
echo '</pre>';


// Đọc mảng
// $hienu  =  $arr2['address3'];
// echo $hienu.'<br>';

// dùng vòng lặp for
// if(!empty($arr)){
//     for($i = 0; $i < count($arr); $i++){
//         echo $arr[$i] .'<br>';
//     }
// }

// dùng foreach

if(!empty($arr2)){
    foreach($arr2 as $key => $value){
        echo $value.'<br>';
    }
}



