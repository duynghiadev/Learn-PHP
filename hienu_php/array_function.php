<?php
$arr = ['CR7', 'Messi', 'Kaka'];

$arr2 = [
    'address1' => 'HTML',
    'address2' => 'JS',
    'address3' => 'PHP',
    'address4' => 'C++'
];

//echo count($arr2);

// Hàm array_values
$arrayNew = array_values($arr2);

echo '<pre>';
print_r($arrayNew);
echo '</pre>';

// Hàm array_keys
echo 'Hàm array_key: ';
$arrKey = array_keys($arr2);

echo '<pre>';
print_r($arrKey);
echo '</pre>';

// Hàm array_pop

echo array_pop($arr2) . '<br>';


// Hàm is_array
$bien = 0;
echo is_array($bien);

// Hàm array_push
echo 'Hàm array_push: ';
$result  = array_push($arr, 'Rooney', 'Nani');

echo '<pre>';
print_r($arr);
echo '</pre>';


// Hàm array_shift
echo 'Xoá phần tử đầu tiên : ';
array_shift($arr);
echo '<pre>';
print_r($arr);
echo '</pre>';


// Hàm array_unshift
echo 'Thêm phần tử vào đầu mảng: ';

$kq  = array_unshift($arr, 'CR7', 'De Gea', 'De Gea');

echo '<pre>';
print_r($arr);
echo '</pre>';

// echo $kq;


// Hàm in_array

$inArr = in_array('Hung', $arr);
//echo 'Kết quả: '.$inArr;

// Hàm sort

$sortArr = sort($arr);
echo 'Mảng sau khi sắp xếp: ';
echo '<pre>';
print_r($arr);
echo '</pre>';

//var_dump($sortArr);

// Hàm array_reverse
$arrayRev = array_reverse($arr);

echo 'Mảng sau khi đảo ngược: ';
echo '<pre>';
print_r($arrayRev);
echo '</pre>';


// Hàm array_merge

$mergerArr = array_merge($arr, $arr2);

echo 'Mảng sau khi nối: ';
echo '<pre>';
print_r($mergerArr);
echo '</pre>';


// Hàm array_rand

$randArr = array_rand($mergerArr, 3);

echo 'Mảng sau khi lấy key: ';
echo '<pre>';
print_r($randArr);
echo '</pre>';

// Hàm array_search

$searchArr = array_search('Messi', $arr);

echo 'Đây là vị trí của KaKa: ' . $searchArr;

// Hàm array_slice

$sliceArr = array_slice($arr, 3, 3);
echo '<pre>';
print_r($sliceArr);
echo '</pre>';

// Hàm array_unique

$uniqueArr = array_unique($arr);
echo 'Mảng sau khi lọc trung lặp: ';
echo '<pre>';
print_r($uniqueArr);
echo '</pre>';

// Hàm array_key_exists

$keyArr = array_key_exists('hienu', $arr2);

var_dump($keyArr);
