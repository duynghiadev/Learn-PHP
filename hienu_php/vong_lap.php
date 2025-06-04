<?php 
/* 
    $i = 10 -> in ra 10
    $i = 9 -> in ra 9
    $i = 8 -> in ra 8
    $i = 6 -> in ra 6 

    $i = 0 -> in ra 8
     $i = 10 -> 
      $i = 6 -> in ra 6
       $i = 7 -> in ra 7
        $i = 8 -> in ra 8
         $i = 9 -> in ra 9
          $i = 10 ->  in ra 10
            $i = 11 \
*/
for($i = 10; $i > 0; $i -= 2){
    echo $i.'<br>';
}

/*
BÀI TẬP VÒNG LẶP FOR
1. Hiển thị số chẵn, số lẻ trong dãy số từ: 1 2 3 4 5 ... 100
Bắt đầu : 1 
Điều kiện lặp : 100
Biến tăng : +1
*/

$start = 1;
$end = 100;

$demSoLe = 0; //Đếm số lẻ
$demSoChan = 0; //Đếm số chẵn

$resultSoLe = null; //Biến để lưu các số lẻ
$resultSoChan = null;  //Biến để lưu các số chẵn

for($i = $start; $i <= 100; $i++){
    //Kiểm tra cái số chẵn - lẻ %
    if($i % 2 == 0){
        //$i sẽ là số chẵn
        $resultSoChan .= $i . '  '; 
        $demSoChan++;
    }
    else {
        //$i sẽ là số lẻ
        $resultSoLe .= $i . ' ';
        $demSoLe++;
    }

}


if($demSoChan > 0 ){
    echo "Tìm thấy ".$demSoChan. " số chẵn la : ".$resultSoChan;
}
else {
    echo "Không tìm thấy số chẵn nào";
}

echo '<br>'; 

if($demSoLe > 0 ){
    echo "Tìm thấy ".$demSoLe. " số lẻ la : ".$resultSoLe;
}
else {
    echo "Không tìm thấy số lẻ nào";
}




/*
 2. Tính giai thừa của 1 số nhập vào và hiển thị kết quả
 Giải thích: 
    Input: Nhập vào số N
    Output: Hiển thị kết quả N!
    Công thức: N! = 1*2*3..*N (N>0)
*/

$n = 10 ;
if($n > 0){
    //xử lý tính giai thừa
    $result = 1; 
    for($i = 1; $i <= $n; $i++){
        $result *= $i;
    }
    echo "Kết quả giai thừa là : ". $result.'<br>';
}
else {
    echo $n." không hợp lệ";
}



