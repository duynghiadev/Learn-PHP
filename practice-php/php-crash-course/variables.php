<?php
    echo "We talk about variables".'<br>';
    $name = 'Hoang'; //string
    $age = 18;//integer
    echo $age;
    $has_mercedes = false;
    echo $has_mercedes;
    var_dump($has_mercedes);
    $product_price = 22.45; //Float
    var_dump($product_price);
    echo "<br>";
    //string concatenation
   echo $name.' is '.$age.' years old'."<br>";
   //this is better
   echo "$name is $age years old...";
    echo "<br>";

   //expression
   echo '1' + '2';
    echo "<br>";

   $sum = '2' + '3';
   echo "<br>";
   var_dump($sum);

   echo 5 * 3;
    echo "<br>";

   echo 10 / 2;
    echo "<br>";

//    echo 5 / 0;
    echo 10 % 3;//remains
    echo "<br>";

    //constants
    define('SERVER_NAME', 'localhost');
    define('DATABASE_NAME', 'test_db');
    echo "server: ".SERVER_NAME.', db : '.DATABASE_NAME;
?>