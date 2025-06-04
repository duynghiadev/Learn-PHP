<?php
// Toán tử gán =
$bien1 = 10;

//Toán tử gán +=
$bien2 = 5;
$bien2 += 10; // $bien2 = $bien2 + 10;
$bien2 += 5;
echo $bien2 . '<br>';


//Toán tử gán -=
$bien3 = 10;
$bien3 -= 3; //$bien3 = $bien3 - 3;
echo $bien3 . '<br>';

//Toán tử gán *=
$bien4 = 3;
$bien4 *= 2; // $bien4 = $bien4 * 2;

echo $bien4 . '<br>';

//Toán tử gán /=
$bien5 = 9;
$bien5 /= 3; // $bien5 = $bien5 / 3;

echo 'Biến 5= ' . $bien5 . '<br>';

// Toàn tử gán %=  -> % chia lấy số dư
$bien6 = 10;
$bien6 %= 7; // $bien6 = $bien6 % 7 ; =3

echo $bien6 . '<br>';

// Toán tử gán .= 
$bien7 = 'hienu';
$bien7 .= ' vũ trụ marketing'; // $bien7 = 'hienu' . 'vũ trụ marketing';
echo $bien7 . '<br>';

//Toán tử số học %
$bien8 = 25;
$bien9 = $bien8 % 20; // dư 5

echo 'Biến 9= ' . $bien9 . '<br>';

//toán tử luỹ thừa **
$bien10 = 2; // cơ số
$bien11 = 3; // số mũ
$bienTong = $bien10 ** $bien11; // 2^3

echo 'Toán tử luý thừa= ' . $bienTong . '<br>';

//Toán tử so sánh ==  so sánh giá trị 
// ===  so sánh tuyệt đối cả về giá trị lẫn kiểu dữ liệu
$bien12 = 10;
$bien13 = '10';

echo $bien12 === $bien13;

//Toán tử so sánh != 
$bien14 = 10;
$bien15 = 10;
echo '<br>';
echo $bien14 != $bien15;

//Toán tử lý luận && -> trả kết quả là kiểu boolean (true,false)
$bien16 = 5;
$bien17 = 10;
$bien18 = 15;

echo ($bien16 < $bien17) && ($bien18 < $bien17);

//Toán tử luận || -> trả boolean
echo 'Đây là toán tử || = <br>';
echo ($bien16 < $bien17) || ($bien18 > $bien17);


// toán tử lý luận ! -> phủ định 
$bien19 = false;

echo 'Đây là phủ định của bien19 = ' . !$bien19;

echo '<br><br>';

// Biến tăng 
$a = 1;
++$a; // $a = $a + 1;   
/*
$a++ -> thao tác với biến a trước (lấy giá trị) rồi mới tăng lên 1 đơn vị.
++$a -> tăng lên 1 đvi trước rồi thao tác vs biến a. 
*/

echo $a . '<br>'; // 2


//Biến giảm 
--$a; //1

echo $a . '<br>';

// CÂU LỆNH ĐIỀU KIỆN (RẼ NHÁNH)
echo "BÀI HỌC CÂU LỆNH RẼ NHÁNH" . '<br>';

$bien1 = 10;

if ($bien1 > 0) {
    echo "Biến 1 đủ điều kiện" . '<br>';
    if ($bien1 > 10) {
        echo " Biến 1 là số lớn ";
    } else {
        echo " Biến 1 là số nhỏ";
    }
} else {
    echo "Biến 1 không đủ điều kiện";
}

echo '<br>';

/*
$bien1 = 10;
- Nếu $bien1 0 0 -> in ra là "Biến 1 lớn hơn 0 "
- Nếu $bien1 = 5 -> in ra là "Biến 1 bằng 5"
- Nếu $biến1 = 10 -> in ra là "biến 1 lớn nhất"
- Những trường hợp còn lại thì in ra "Biến 1 nhỏ hơn 0" 
*/

// $bien1 = 0;
// if($bien1 == 0){
//     echo "Biến 1 bằng 0";
// }
// elseif($bien1 == 5){
//    echo "Biến 1 bằng 5";
// }
// elseif($bien1 == 10){
//     echo "Biến 1 bằng 10";
// }
// else {
//     echo "Đây là các trường hợp còn lại";
// }


// CÂU LỆNH ĐIỀU KIỆN (RẼ NHÁNH)
echo "BÀI HỌC CÂU LỆNH RẼ NHÁNH SWITCH - CASE" . '<br>';
/* 
$day = 2;
- nếu $day = 2 -> in ra là "Hôm nay là thứ Hai"
- nếu $day = 3 -> in ra là "Hôm nay là thứ Ba"
- nếu $day = 4 -> in ra là "Hôm nay là thứ Tư"
- 
-
-
- nếu $day = 8 -> in ra là "Hôm nay là Chủ Nhật"

*/

$day = 100;
switch ($day) {
    case 2:
        echo "Hôm nay là thứ Hai";
        break;
    case 3:
        echo "Hôm nay là thứ Ba";
        break;
    case 4:
        echo "Hôm nay là thứ Tư";
        break;
    case 5:
        echo "Hôm nay là thứ Năm";
        break;
    case 6:
        echo "Hôm nay là thứ Sáu";
        break;
    case 7:
        echo "Hôm nay là thứ Bảy";
        break;
    default:
        echo "Hôm nay là Chủ Nhật";
        break;
}


