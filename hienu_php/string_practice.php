<?php 
/*
 Bài 1: Viết chương trình lấy 5 ký tự cuối chuỗi
 chuỗi là tiếng việt - tiếng việt ko dấu

*/

$str = "Hoc lap trinh";
$endStr = substr($str, -5);
echo '5 ký tự cuối của chuỗi str là : '.$endStr.'<br>';

$str2 = "Học lập trình";
$endStr2 = mb_substr($str2, -5, null, 'UTF-8');
echo '5 ký tự cuối của chuỗi str2 là : '.$endStr2.'<br>';






/*
 Bài 2: Viết chương trình xoá chữ đầu tiên trong chuỗi
 Input: Phạm Ngọc Hùng
 Output: Ngọc Hùng
*/

$strName = 'Pham Ngoc Hung';

// Tính vị trí khoảng trắng đầu tiên
$posSpace = strpos($strName,' ');

// Tính vị trí của chữ N
$posStr = $posSpace +1 ;

// Độ dài chuỗi muốn cắt
$endWordLen = strlen($strName) - $posStr;

// Cắt chuỗi
$endWord = substr($strName, $posStr, $endWordLen);

echo '<br>'. $endWord.'<br>';



// Chuỗi có dấu 
$strName2 = 'Phạm Ngọc Hùng';

// Tính vị trí khoảng trắng đầu tiên
$posSpace2 = mb_strpos($strName2,' ', 0, 'UTF-8');

// Tính vị trí của chữ N
$posStr2 = $posSpace2 +1 ;

// Độ dài chuỗi muốn cắt
$endWordLen2 = mb_strlen($strName2, 'UTF-8') - $posStr;

// Cắt chuỗi
$endWord2 = mb_substr($strName2, $posStr2, $endWordLen2);

echo '<br>'. $endWord2.'<br>';



