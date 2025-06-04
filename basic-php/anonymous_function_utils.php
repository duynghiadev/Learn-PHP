<?php

declare(strict_types=1); // Enable strict typing

// Custom exception for anonymous function utilities
class AnonymousFunctionException extends Exception {}

// Include_once function_examples.php for compareValuesExample
try {
  if (!@include_once 'function_examples.php') {
    throw new AnonymousFunctionException("Failed to include_once function_examples.php");
  }
} catch (AnonymousFunctionException $e) {
  error_log($e->getMessage());
  echo "Warning: {$e->getMessage()}<br>";
}

// Require_once advanced_function_examples.php for transformValueType
try {
  require_once 'advanced_function_examples.php';
} catch (Error $e) {
  error_log("Fatal error: {$e->getMessage()}");
  echo "Fatal error: {$e->getMessage()}<br>";
}

// Anonymous function: Combine value and reference processing
$combineValueAndReference = function (mixed $value, DataContainer $object) use (&$combineValueAndReference): string {
  $result = [];
  // Process value type
  global $transformValueType;
  if (isset($transformValueType) && is_callable($transformValueType)) {
    $result[] = $transformValueType($value, 'default');
  } else {
    $result[] = "transformValueType not available";
  }

  // Process reference type
  if (is_scalar($value) || is_array($value)) {
    $tempValue = $value;
    if (function_exists('processReferenceType')) {
      $result[] = processReferenceType($tempValue, $object);
    } else {
      $result[] = "processReferenceType not available";
    }
  } else {
    $result[] = "Unsupported value type for reference processing: " . gettype($value);
  }

  // Recursive call for arrays
  if (is_array($value)) {
    foreach ($value as $item) {
      $result[] = $combineValueAndReference($item, $object);
    }
  }

  return "Anonymous combined processing: Value: $value, Object: $object; Results: " . implode("; ", $result);
};
