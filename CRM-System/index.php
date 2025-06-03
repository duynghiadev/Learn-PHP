<?php

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$sum = 0;
$count = 0;
$max = $arr[0];
$min = $arr[0];
$old = 0;

for ($i = 0; $i < count($arr); $i++) {
  $sum += $arr[$i];
  $count++;
  if ($arr[$i] > $max) {
    $max = $arr[$i];
  }
  if ($arr[$i] < $min) {
    $min = $arr[$i];
  }
}

if ($old == 0) {
  echo "old = 0 <br>";
  echo "================ <br>";
}

define("OLD", 1);
echo "old = " . OLD . "<br>";
echo "================ <br>";

$array1 = [1, 2, 3, 4, 5];
$array2 = [6, 7, 8, 9, 10];
$array3 = array_merge($array1, $array2);
foreach ($array3 as $value) {
  echo $value . " ";
}
echo "<br>";
echo "================ <br>";


echo "sum = $sum <br>";
echo "count = $count <br>";
echo "max = $max <br>";
echo "min = $min <br>";
echo "average = " . $sum / $count . "<br>";
