<?php 
$bienToanCuc = 100;

function makeTotal($a,$b){ // hàm ko return
    $tong = $a + $b;
    echo 'Tông phía sau return là : '.$tong;
    return $tong;

}

function doCount(){
    static $number = 0;
    $number++;
    echo $number.'<br>';
}

doCount();
doCount();
doCount();
doCount();





