<?php
for($i = 0; $i < 10; $i++){
    if($i == 5){
       continue;
    }
    echo $i.'<br>';
}

echo "Vòng lặp while: ";

$i = 0;
while($i < 10){
    echo $i.'<br>';
    $i++;
}

die('Tạm dừng chương trình');


echo '<br>' ."Vòng lặp do-while: <br>";

$j = 10;
do {
    echo $j.'<br>';
    $j++;
} while($j < 10);


?>