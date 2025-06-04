<?php

function calculateArrayStats(array $arr): array
{
  if (empty($arr)) {
    return [
      'sum' => 0,
      'count' => 0,
      'max' => null,
      'min' => null,
      'average' => null
    ];
  }

  $sum = 0;
  $count = 0;
  $max = $arr[0];
  $min = $arr[0];

  foreach ($arr as $value) {
    if (!is_numeric($value)) {
      throw new InvalidArgumentException("Array must contain only numeric values, got " . gettype($value) . " ('$value')");
    }
    $sum += (float)$value;
    $count++;
    if ($value > $max) {
      $max = $value;
    }
    if ($value < $min) {
      $min = $value;
    }
  }

  return [
    'sum' => $sum,
    'count' => $count,
    'max' => $max,
    'min' => $min,
    'average' => $count > 0 ? $sum / $count : null
  ];
}

function mergeAndPrintArrays(array $array1, array $array2): void
{
  $array3 = array_merge($array1, $array2);
  foreach ($array3 as $value) {
    echo $value . " ";
  }
  echo "<br>";
}
