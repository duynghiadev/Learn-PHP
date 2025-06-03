<?php

require_once 'array_operations.php';
require_once 'comparison_operations.php';

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$old = 0;

if ($old == 0) {
  echo "old = 0 <br>";
  echo "================ <br>";
}

define("OLD", 1);
echo "old = " . OLD . "<br>";
echo "================ <br>";

$array1 = [1, 2, 3, 4, 5];
$array2 = [6, 7, 8, 9, 10];
mergeAndPrintArrays($array1, $array2);
echo "================ <br>";

$a = 10;
$b = 10;
compareValues($a, $b);

$stats = calculateArrayStats($arr);
echo "sum = {$stats['sum']} <br>";
echo "count = {$stats['count']} <br>";
echo "max = {$stats['max']} <br>";
echo "min = {$stats['min']} <br>";
echo "average = {$stats['average']} <br>";

$data_type = gettype($arr);
echo "<pre>";
var_dump($data_type);
echo "</pre>";
