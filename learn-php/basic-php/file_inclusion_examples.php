<?php

declare(strict_types=1); // Enable strict typing

// Custom exception for file inclusion errors
class FileInclusionException extends Exception {}

// Attempt to include files with different directives, handling errors
try {
  // include_once: Non-fatal if missing, single inclusion
  if (!@include_once 'array_operations.php') {
    throw new FileInclusionException("Failed to include_once array_operations.php");
  }
} catch (FileInclusionException $e) {
  error_log($e->getMessage());
  echo "Warning: {$e->getMessage()}<br>";
}

try {
  // include_once: Non-fatal, single inclusion
  if (!@include_once 'comparison_operations.php') {
    throw new FileInclusionException("Failed to include_once comparison_operations.php");
  }
} catch (FileInclusionException $e) {
  error_log($e->getMessage());
  echo "Warning: {$e->getMessage()}<br>";
}

try {
  // require_once: Fatal if missing, single inclusion
  require_once 'function_examples.php'; // Changed from require to require_once
} catch (Error $e) {
  error_log("Fatal error: {$e->getMessage()}");
  echo "Fatal error: {$e->getMessage()}<br>";
}

try {
  // require_once: Fatal if missing, single inclusion
  require_once 'advanced_function_examples.php';
} catch (Error $e) {
  error_log("Fatal error: {$e->getMessage()}");
  echo "Fatal error: {$e->getMessage()}<br>";
}

// Function with parameters: Combine included functions for value type processing
function combineValueProcessing(mixed $value, array $options = []): string
{
  $result = [];
  $defaultOptions = ['strict' => true, 'transform' => false];
  $options = array_merge($defaultOptions, $options);

  // Use function from comparison_operations.php
  if (function_exists('compareValues')) {
    $result[] = compareValues($value, 0, $options['strict']);
  } else {
    $result[] = "compareValues not available";
  }

  // Use function from function_examples.php
  if (function_exists('compareValuesExample')) {
    $result[] = compareValuesExample($value, "0", $options['strict']);
  } else {
    $result[] = "compareValuesExample not available";
  }

  // Use function from advanced_function_examples.php
  if (function_exists('processValueType') && $options['transform']) {
    $result[] = processValueType($value);
  } else {
    $result[] = "processValueType not called or unavailable";
  }

  return implode("; ", $result);
}

// Function with parameters: Combine reference type processing using included functions
function combineReferenceProcessing(mixed &$value, DataContainer $object): string
{
  $result = [];
  $originalValue = $value;

  // Use function from advanced_function_examples.php
  if (function_exists('processReferenceType')) {
    $result[] = processReferenceType($value, $object);
  } else {
    $result[] = "processReferenceType not available";
  }

  // Use anonymous function from advanced_function_examples.php
  global $modifyReferenceType;
  if (isset($modifyReferenceType) && is_callable($modifyReferenceType)) {
    $result[] = $modifyReferenceType($value, $object);
  } else {
    $result[] = "modifyReferenceType not available";
  }

  return "Combined reference processing: Original: $originalValue, Modified: $value, Object: $object; Results: " . implode("; ", $result);
}

// Anonymous function: Process value types using included functions
$processIncludedValue = function (mixed $value) use (&$processIncludedValue): string {
  $result = [];

  // Recursive call for arrays
  if (is_array($value)) {
    foreach ($value as $item) {
      $result[] = $processIncludedValue($item);
    }
    return "Array processed: " . implode("; ", $result);
  }

  // Use function from array_operations.php
  if (function_exists('calculateArrayStats') && is_numeric($value)) {
    $result[] = "Stats for [$value]: " . print_r(calculateArrayStats([$value]), true);
  } else {
    $result[] = "calculateArrayStats not available or non-numeric";
  }

  // Use function from advanced_function_examples.php
  global $transformValueType;
  if (isset($transformValueType) && is_callable($transformValueType)) {
    $result[] = $transformValueType($value, 'default');
  } else {
    $result[] = "transformValueType not available";
  }

  return "Anonymous value processing: " . implode("; ", $result);
};

// Anonymous function: Process reference types using included functions
$processIncludedReference = function (mixed &$value, DataContainer $object) use (&$processIncludedReference): string {
  $originalValue = $value;
  $result = [];

  // Use function from advanced_function_examples.php
  if (function_exists('safeObjectProcess')) {
    $result[] = safeObjectProcess($object, fn($obj) => $obj->increment());
  } else {
    $result[] = "safeObjectProcess not available";
  }

  // Recursive call for arrays
  if (is_array($value)) {
    foreach ($value as &$item) {
      $result[] = $processIncludedReference($item, $object);
    }
    unset($item); // Unset reference to avoid issues
    $value[] = 'included_ref';
  } elseif (is_scalar($value)) {
    $value .= '_included_ref';
    $object->increment();
    $result[] = "Scalar modified: $value, Object: $object";
  } else {
    $result[] = "Unsupported type: " . gettype($value);
  }

  return "Anonymous reference processing: Original: $originalValue, Modified: $value, Object: $object; Results: " . implode("; ", $result);
};
