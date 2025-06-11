<?php

declare(strict_types=1); // Enable strict typing

// Custom exception for reference type utilities
class ReferenceTypeException extends Exception {}

// Require advanced_function_examples.php for DataContainer class
try {
  require 'advanced_function_examples.php';
} catch (Error $e) {
  error_log("Fatal error: {$e->getMessage()}");
  echo "Fatal error: {$e->getMessage()}<br>";
}

// Function with parameters: Modify reference type (pass-by-reference and object)
function modifyReference(mixed &$value, DataContainer $object): string
{
  $originalValue = $value;
  if (is_scalar($value)) {
    $value .= '_ref_util';
    $object->increment();
    return "Reference modified: Original: $originalValue, New: $value, Object: $object";
  } elseif (is_array($value)) {
    $value[] = 'ref_util';
    $object->increment();
    return "Array reference modified: Original count: " . (count($originalValue)) . ", New count: " . count($value) . ", Object: $object";
  }
  throw new ReferenceTypeException("Value must be scalar or array, got " . gettype($value));
}

// Anonymous function: Clone and modify object
$cloneAndModifyObject = function (DataContainer $object): string {
  $cloned = clone $object;
  $cloned->increment();
  return "Anonymous clone: Original: $object, Cloned: $cloned";
};
