<?php

// Enable error reporting for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Use a mix of include, include_once, require, and require_once
include_once 'array_operations.php';
include_once 'comparison_operations.php';
require_once 'function_examples.php'; // Changed from require to require_once
require_once 'advanced_function_examples.php';
require_once 'file_inclusion_examples.php';
require_once 'value_type_utils.php';
include 'reference_type_utils.php';
include_once 'anonymous_function_utils.php';

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

try {
  echo "8. processValueType(42): " . processValueType(42) . "<br>";
  echo "processValueType(3.14): " . processValueType(3.14) . "<br>";
  echo "processValueType('test'): " . processValueType('test') . "<br>";
  echo "processValueType(true): " . processValueType(true) . "<br>";
  echo "processValueType([1, 2]): " . processValueType([1, 2]) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "9. processReferenceType:<br>";
  $value = "original";
  $object = new DataContainer("Test");
  echo "Before: Value: $value, Object: $object<br>";
  echo processReferenceType($value, $object) . "<br>";
  echo "After: Value: $value, Object: $object<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

echo "10. createDataObject: " . createDataObject() . "<br>";
echo "createDataObject (second call): " . createDataObject() . "<br>";
echo "================ <br>";

try {
  echo "11. safeObjectProcess:<br>";
  $object = new DataContainer("SafeTest");
  echo safeObjectProcess($object, fn($obj) => $obj->increment()) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "12. transformValueType:<br>";
  echo $transformValueType(5, 'increment') . "<br>";
  echo $transformValueType('hello', 'reverse') . "<br>";
  echo $transformValueType(true, 'negate') . "<br>";
  echo $transformValueType([1, 2, 3], 'default') . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "13. modifyReferenceType:<br>";
  $value = "anon_test";
  $object = new DataContainer("AnonTest");
  echo "Before: Value: $value, Object: $object<br>";
  echo $modifyReferenceType($value, $object) . "<br>";
  echo "After: Value: $value, Object: $object<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "14. processWithCustomLogic:<br>";
  echo $processWithCustomLogic(10, fn($x) => is_numeric($x) ? $x * 2 : $x) . "<br>";
  echo $processWithCustomLogic("test", fn($x) => strtoupper($x)) . "<br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

// Examples from file_inclusion_examples.php
echo "=== Examples from file_inclusion_examples.php ===<br>";

try {
  echo "1. combineValueProcessing(5): " . combineValueProcessing(5, ['strict' => true, 'transform' => true]) . "<br>";
  echo "combineValueProcessing('5', loose): " . combineValueProcessing("5", ['strict' => false, 'transform' => false]) . "<br>";
} catch (FileInclusionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "2. combineReferenceProcessing:<br>";
  $value = "ref_test";
  $object = new DataContainer("RefTest");
  echo "Before: Value: $value, Object: $object<br>";
  echo combineReferenceProcessing($value, $object) . "<br>";
  echo "After: Value: $value, Object: $object<br>";
} catch (FileInclusionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "3. processIncludedValue:<br>";
  echo $processIncludedValue(10) . "<br>";
  echo $processIncludedValue(['a', 2]) . "<br>";
} catch (FileInclusionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "4. function processIncludedReference:<br>";
  $value = "include_ref";
  $object = new DataContainer("IncludeTest");
  echo "Before: Value: $value, Object: $object<br>";
  echo $processIncludedReference($value, $object) . "<br>";
  echo "After: Value: $value, Object: $object<br>";
} catch (FileInclusionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

// Examples from value_type_utils.php
echo "=== Examples from value_type_utils.php ===<br>";

try {
  echo "1. processScalarValue(42): " . processScalarValue(42) . "<br>";
  echo "processScalarValue('test'): " . processScalarValue('test') . "<br>";
} catch (ValueTypeException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "2. transformValueArray([1, 'abc']): " . implode(", ", $transformValueArray([1, 'abc'])) . "<br>";
} catch (ValueTypeException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

// Examples from reference_type_utils.php
echo "=== Examples from reference_type_utils.php ===<br>";

try {
  echo "1. modifyReference:<br>";
  $value = "ref_util_test";
  $object = new DataContainer("RefUtilTest");
  echo "Before: Value: $value, Object: $object<br>";
  echo modifyReference($value, $object) . "<br>";
  echo "After: Value: $value, Object: $object<br>";
} catch (ReferenceTypeException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

try {
  echo "2. cloneAndModifyObject: " . $cloneAndModifyObject(new DataContainer("CloneTest")) . "<br>";
} catch (ReferenceTypeException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";

// Examples from anonymous_function_utils.php
echo "=== Examples from anonymous_function_utils.php ===<br>";

try {
  echo "1. combineValueAndReference:<br>";
  $value = "combined_test";
  $object = new DataContainer("CombinedTest");
  echo $combineValueAndReference($value, $object) . "<br>";
} catch (AnonymousFunctionException $e) {
  echo "Error: " . $e->getMessage() . "<br>";
}
echo "================ <br>";
