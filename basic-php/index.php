<?php

// Enable error reporting for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'array_operations.php';
require_once 'comparison_operations.php';
require_once 'function_operations.php';
require_once 'advanced_function_examples.php';

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
echo "================ <br>";

$stats = calculateArrayStats($arr);
echo "sum = {$stats['sum']} <br>";
echo "count = {$stats['count']} <br>";
echo "max = {$stats['max']} <br>";
echo "min = {$stats['min']} <br>";
echo "average = {$stats['average']} <br>";
echo "================ <br>";

$data_type = gettype($arr);
echo "<pre>";
var_dump($data_type);
echo "</pre>";
echo "================ <br>";

// Examples from function_examples.php
echo "=== Examples from function_examples.php ===<br>";

echo "1. addNumbers(5, 3): " . addNumbers(5, 3) . "<br>";
echo "addNumbers(5): " . addNumbers(5) . "<br>";
echo "================ <br>";

echo "2. compareValuesExample(10, '10', true): " . compareValuesExample(10, "10", true) . "<br>";
echo "compareValuesExample(10, '10', false): " . compareValuesExample(10, "10", false) . "<br>";
echo "================ <br>";

echo "3. sumNumbers(1.5, 2.5, 3.5): " . sumNumbers(1.5, 2.5, 3.5) . "<br>";
echo "================ <br>";

echo "4. compareGreater(8, 5): " . ($compareGreater(8, 5) ? "Yes" : "No") . "<br>";
echo "================ <br>";

echo "5. compareLess(3, 7): " . ($compareLess(3, 7) ? "Yes" : "No") . "<br>";
echo "================ <br>";

try {
  echo "6. factorial(5): " . factorial(5) . "<br>";
} catch (InvalidArgumentException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

echo "7. applyComparison(10, 5, compareGreater): " . applyComparison(10, 5, $compareGreater) . "<br>";
echo "applyComparison(10, 15, compareLess): " . applyComparison(10, 15, $compareLess) . "<br>";
echo "================ <br>";

try {
  echo "8. analyzeType(42): " . analyzeType(42) . "<br>";
  echo "analyzeType(3.14159): " . analyzeType(3.14159) . "<br>";
  echo "analyzeType('Hello'): " . analyzeType("Hello") . "<br>";
  echo "analyzeType([1, 2, 3]): " . analyzeType([1, 2, 3]) . "<br>";
} catch (InvalidArgumentException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

echo "9. generateComparisons(10, 5):<br>";
foreach (generateComparisons(10, 5) as $index => $result) {
  echo "[$index] $result<br>";
}
echo "================ <br>";

// Examples from advanced_function_examples.php
echo "=== Examples from advanced_function_examples.php ===<br>";

try {
  echo "1. curryCompare:<br>";
  $greaterThan = curryCompare(fn($x, $y) => $x > $y, 15);
  echo $greaterThan(10) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "2. memoizedCalculate('sum', 1.5, 2.5, 3.5): " . memoizedCalculate('sum', 1.5, 2.5, 3.5) . "<br>";
  echo "memoizedCalculate('product', 2, 3, 4): " . memoizedCalculate('product', 2, 3, 4) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "3. transformData:<br>";
  $data = [1, 2, 3];
  $transformed = transformData($data, fn($value) => $value * 2, true);
  echo "Transformed array: " . implode(", ", $transformed) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

echo "4. getSystemConfig:<br>";
echo "Config: " . print_r(getSystemConfig(), true) . "<br>";
echo "================ <br>";

echo "5. getNextId: " . getNextId() . "<br>";
echo "getNextId (second call): " . getNextId() . "<br>";
echo "================ <br>";

echo "6. generateOperationLog: " . generateOperationLog() . "<br>";
echo "generateOperationLog (second call): " . generateOperationLog() . "<br>";
echo "================ <br>";

try {
  echo "7. processValue(42, 'strict'): " . processValue(42, 'strict') . "<br>";
  echo "processValue(3.14159, 'strict'): " . processValue(3.14159, 'strict') . "<br>";
  echo "processValue('Hello', 'loose'): " . processValue('Hello', 'loose') . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";
