<?php

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$sum = 0;
$count = 0;
$max = $arr[0];
$min = $arr[0];

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

echo "sum = $sum <br>";
echo "count = $count <br>";
echo "max = $max <br>";
echo "min = $min <br>";
echo "average = " . $sum / $count . "<br>";
