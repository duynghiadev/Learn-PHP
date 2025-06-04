<?php
// is_numeric() : kiểm tra kiểu số (số nguyên số thực)
$bien1 = 4.9;
$result = is_numeric($bien1);

var_dump($result);

// is_int(): Kiêm tra kiêu số nguyên
$checkInt = is_int($bien1);
echo '<br>';
var_dump($checkInt);


// is_float: Kiêm tra kiêu số thực
$checkFloat = is_float($bien1);
echo '<br>'.'Kiểm tra số thực: ';
var_dump($checkFloat);


// ép kiểu số nguyên
$bien2 = (int)$bien1;
echo '<br>';
var_dump($bien2);

// ép kiểu số thực
$soNguyen = 5;
$soNguyen = (float)$soNguyen;
echo '<br>';
var_dump($soNguyen);

// Làm tròn round()
$bien3 = 1.129456789;
$kq = round($bien3, 8);

echo '<br>'.$kq;

// Làm tròn xuống floor()
$bien4 = 1.3;
$kq4 = floor($bien4);
echo '<br>';
echo 'Làm tròn xuống: '.$kq4;

// Làm tròn lên ceil()
$kq5 = ceil($bien4);
echo '<br>';
echo 'Làm tròn lên: '.$kq5;


// Lấy số ngẫu nhiên rand()
$bien5 = rand();
echo '<br>';
echo 'Lấy số ngẫu nhiên: '.$bien5;
