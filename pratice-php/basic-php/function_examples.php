<?php

declare(strict_types=1); // Enable strict typing for better type safety

// Define closures in global scope for accessibility
global $compareGreater, $compareLess;

// Basic function with default parameters and return type
function addNumbers(float $a, float $b = 0.0): float
{
  return $a + $b;
}

// Function with named arguments and type checking (renamed to avoid conflict)
function compareValuesExample(mixed $x, mixed $y, bool $strict = true): string
{
  try {
    if ($strict) {
      return ($x === $y) ? "Strictly equal (type and value)" : "Not strictly equal";
    }
    return ($x == $y) ? "Loosely equal (value only)" : "Not equal";
  } catch (TypeError $e) {
    return "Error: " . $e->getMessage();
  }
}

// Variadic function to sum multiple numbers
function sumNumbers(float ...$numbers): float
{
  $sum = 0.0;
  foreach ($numbers as $number) {
    $sum += $number;
  }
  return $sum;
}

// Anonymous function (closure) for comparison
$compareGreater = function (mixed $a, mixed $b): bool {
  return $a > $b;
};

// Arrow function for quick comparison
$compareLess = fn(mixed $a, mixed $b): bool => $a < $b;

// Recursive function to calculate factorial
function factorial(int $n): int
{
  if ($n < 0) {
    throw new InvalidArgumentException("Factorial is not defined for negative numbers");
  }
  return $n === 0 ? 1 : $n * factorial($n - 1);
}

// Higher-order function that accepts a callable
function applyComparison(mixed $a, mixed $b, callable $comparison): string
{
  return $comparison($a, $b) ? "Comparison true" : "Comparison false";
}

// Function to demonstrate error handling and switch-case
function analyzeType(mixed $value): string
{
  switch (gettype($value)) {
    case 'integer':
      return "Integer value: $value, doubled: " . ($value * 2);
    case 'double':
      return "Float value: $value, rounded: " . round($value, 2);
    case 'string':
      return "String value: $value, length: " . strlen($value);
    case 'array':
      return "Array with " . count($value) . " elements";
    default:
      throw new InvalidArgumentException("Unsupported type: " . gettype($value));
  }
}

// Generator function to yield comparison results
function generateComparisons(mixed $a, mixed $b): Generator
{
  yield "Strict equality: " . ($a === $b ? "equal" : "not equal");
  yield "Loose equality: " . ($a == $b ? "equal" : "not equal");
  yield "Spaceship (a <=> b): " . ($a <=> $b);
  if (is_numeric($a) && is_numeric($b)) {
    yield "Bitwise AND (a & b): " . ($a & $b);
  }
}
