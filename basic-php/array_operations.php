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

function calculate2DArrayStats(array $arr): array
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
  $max = null;
  $min = null;

  foreach ($arr as $subArray) {
    if (!is_array($subArray)) {
      throw new InvalidArgumentException("All elements must be arrays, got " . gettype($subArray));
    }
    foreach ($subArray as $value) {
      if (!is_numeric($value)) {
        throw new InvalidArgumentException("All values must be numeric, got " . gettype($value) . " ('$value')");
      }
      $value = (float)$value;
      $sum += $value;
      $count++;
      if ($max === null || $value > $max) {
        $max = $value;
      }
      if ($min === null || $value < $min) {
        $min = $value;
      }
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

function mergeAndPrint2DArrays(array $array1, array $array2): void
{
  $merged = array_merge($array1, $array2);
  foreach ($merged as $index => $subArray) {
    if (!is_array($subArray)) {
      throw new InvalidArgumentException("All elements must be arrays, got " . gettype($subArray) . " at index $index");
    }
    echo "Row $index: ";
    foreach ($subArray as $value) {
      echo $value . " ";
    }
    echo "<br>";
  }
}
