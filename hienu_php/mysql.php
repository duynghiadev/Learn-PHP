

<?php 

//Tạo class
class Hienu {
    public function tinhtong($a,$b){
        $tong = $a + $b;
        echo $tong;
    }

    public function show (){
        echo 'Đây là hàm trong class';
    }
}

$bien1 = new Hienu ;

$bien1 -> show();

echo '<br>';

$a =10;
$b =5;

$bien1 -> tinhtong($a, $b);



