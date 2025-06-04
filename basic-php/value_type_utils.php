<?php

declare(strict_types=1); // Enable strict typing

// Custom exception for value type utilities
class ValueTypeException extends Exception {}

// Include a helper file (simulated, assuming it exists)
try {
  if (!@include_once 'array_operations.php') { // Changed from include to include_once
    throw new ValueTypeException("Failed to include_once array_operations.php");
  }
} catch (ValueTypeException $e) {
  error_log($e->getMessage());
  echo "Warning: {$e->getMessage()}<br>";
}

// Function with parameters: Process scalar value types
function processScalarValue(mixed $value): string
{
  if (!is_scalar($value)) {
    throw new ValueTypeException("Value must be scalar, got " . gettype($value));
  }
  $result = match (gettype($value)) {
    'integer' => "Integer: $value, tripled: " . ($value * 3),
    'double' => "Float: $value, halved: " . ($value / 2),
    'string' => "String: $value, reversed: " . strrev($value),
    'boolean' => "Boolean: " . ($value ? 'true' : 'false'),
    default => throw new ValueTypeException("Unsupported scalar type: " . gettype($value))
  };
  // Use included function if available
  if (function_exists('calculateArrayStats')) {
    $result .= "; Stats: " . print_r(calculateArrayStats([$value]), true);
  }
  return $result;
}

// Anonymous function: Transform value type array
$transformValueArray = function (array $values): array {
  return array_map(
    fn($v) => is_numeric($v) ? $v + 5 : strtoupper((string)$v),
    $values
  );
};
