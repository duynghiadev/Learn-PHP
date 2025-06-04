<?php 
// $bien1 = 'hienu';
// $bien2 = "hienu";

// define('_AGENCY','hienu');
// define('_AGENCY2',"hienu");

// Hàm explode
$chuoi1 = 'Học | Lập | Trình | PHP';

$arr = explode('|',$chuoi1);

var_dump($chuoi1);
echo '<br>';
var_dump($arr);
echo '<br>';

print_r($arr);
echo '<br>';


// Hàm implode

$chuoi2 = implode(' ',$arr);

echo $chuoi2.'<br>';

// Hàm strlen -> độ dài của chuỗi
$chuoi3 = 'Hoc lap trinh PHP';
echo strlen($chuoi3).'<br>';

// Hàm str_word_count -> đếm số chữ -> ko hỗ trợ tiếng việt 
echo str_word_count($chuoi3).'<br>';

// Hàm str_repeat
echo "Hàm str_repeat: ";
echo str_repeat($chuoi3,3).'<br>';

// Hàm str_replace 
$chuoi4 = "Học - lập - trình - PHP" ;
echo str_replace('-',' ',$chuoi4).'<br>';

// Hàm mã hoá md5
$chuoi5 = 'hoclaptrinh';
echo md5($chuoi5).'<br>';

// Hàm mã hoá sha1
echo sha1($chuoi5).'<br>';

// Hàm htmlentities
$chuoi6 = '<p>hienu</p>';
echo htmlentities($chuoi6).'<br>';

// Hàm html_entity_decode
echo html_entity_decode($chuoi6).'<br>';

// Hàm strip_tags
echo strip_tags($chuoi6).'<br>';

// Hàm substr
$chuoi7 = "hoc lap trinh PHP";
$chuoimoi = substr($chuoi7, 4, 3);
echo $chuoimoi.'<br>';

// Hàm strstr
$chuoi8 = 'Vu tru marketing - Hienu';
echo strstr($chuoi8, 'tru').'<br>';

// Hàm strpos
$strpos = strpos($chuoi8, 'choi');
echo $strpos.'<br>';

// Hàm substr_replace
echo substr_replace($chuoi8, 'Website', 6, 10).'<br>';

// Hàm strtolower
$chuoi9 = 'HiEnu';
echo strtolower($chuoi9).'<br>';

// Hàm strtoupper
$chuoi10 = 'hienu';
echo strtoupper($chuoi10).'<br>';

// Hàm ucfirst 
echo ucfirst($chuoi10).'<br>';

// Hàm lcfirst
$chuoi11 = 'HIENU';
echo 'Hàm lcfirst: '.lcfirst($chuoi11).'<br>';

// Hàm ucwords
$chuoi12 = "Vu tru marketing";
echo 'Hàm ucwords: '.ucwords($chuoi12).'<br>';

// Hàm trim
$chuoi13 = 'k hienu k';
echo trim($chuoi13, 'k') .'<br>';

// Hàm json_encode và json_decode
$arr= [1,2,3,4,5];
$jsonencode = json_encode($arr);
echo $jsonencode.'<br>';
var_dump($jsonencode);
echo 'chuỗi json sau khi decode: :';
$jsondecode = json_decode($jsonencode,true);
print_r($jsondecode);

