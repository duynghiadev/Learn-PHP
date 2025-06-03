<?php

function calculateArrayStats($arr)
{
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

  return [
    'sum' => $sum,
    'count' => $count,
    'max' => $max,
    'min' => $min,
    'average' => $sum / $count
  ];
}

function mergeAndPrintArrays($array1, $array2)
{
  $array3 = array_merge($array1, $array2);
  foreach ($array3 as $value) {
    echo $value . " ";
  }
  echo "<br>";
}
