<?php

function compareValues($a, $b)
{
  // Determine comparison case for switch
  $comparison = null;
  if ($a === $b) {
    $comparison = 'equal';
  } elseif ($a > $b) {
    $comparison = 'greater';
  } elseif ($a < $b) {
    $comparison = 'less';
  }

  // Switch-case to handle different comparison scenarios
  switch ($comparison) {
    case 'equal':
      echo "a === b (strict equality, same value and type: " . gettype($a) . ")<br>";
      // Bitwise AND to check binary compatibility
      if (is_numeric($a) && is_numeric($b)) {
        echo "Bitwise AND (a & b): " . ($a & $b) . "<br>";
      }
      break;

    case 'greater':
      echo "a > b (a: $a, b: $b)<br>";
      // Bitwise XOR to highlight differences
      if (is_numeric($a) && is_numeric($b)) {
        echo "Bitwise XOR (a ^ b): " . ($a ^ $b) . "<br>";
      }
      break;

    case 'less':
      echo "a < b (a: $a, b: $b)<br>";
      // Bitwise OR for combined bits
      if (is_numeric($a) && is_numeric($b)) {
        echo "Bitwise OR (a | b): " . ($a | $b) . "<br>";
      }
      break;

    default:
      echo "Invalid comparison or non-numeric types detected<br>";
      break;
  }
  echo "================ <br>";

  // Type juggling demonstration
  try {
    $looseComparison = ($a == (string)$b) ? "a == b (loose, after type juggling to string)" : "a != b (loose)";
    echo $looseComparison . "<br>";
  } catch (TypeError $e) {
    echo "TypeError in loose comparison: " . $e->getMessage() . "<br>";
  }
  echo "================ <br>";

  // Logical NOT with anonymous function
  $logicalNot = function ($value, $name) {
    return !$value ? "!$name evaluates to true" : "$name evaluates to true";
  };
  echo $logicalNot($a, 'a') . "<br>";
  echo $logicalNot($b, 'b') . "<br>";
  echo "================ <br>";

  // Pre-increment with type checking
  if (is_numeric($a)) {
    echo "Pre-increment ++a: " . (++$a) . " (type: " . gettype($a) . ")<br>";
  } else {
    echo "Pre-increment skipped: a is not numeric<br>";
  }
  echo "================ <br>";

  // Post-increment with type checking
  if (is_numeric($a)) {
    echo "Post-increment a++: " . ($a++) . "<br>";
    echo "a after post-increment: " . $a . " (type: " . gettype($a) . ")<br>";
  } else {
    echo "Post-increment skipped: a is not numeric<br>";
  }
  echo "================ <br>";

  // Pre-decrement with type checking
  if (is_numeric($b)) {
    echo "Pre-decrement --b: " . (--$b) . " (type: " . gettype($b) . ")<br>";
  } else {
    echo "Pre-decrement skipped: b is not numeric<br>";
  }
  echo "================ <br>";

  // Post-decrement with type checking
  if (is_numeric($b)) {
    echo "Post-decrement b--: " . ($b--) . "<br>";
    echo "b after post-decrement: " . $b . " (type: " . gettype($b) . ")<br>";
  } else {
    echo "Post-decrement skipped: b is not numeric<br>";
  }
  echo "================ <br>";

  // Complex ternary operator with nested conditions
  echo "Complex ternary: " . (
    is_numeric($a) && is_numeric($b)
    ? ($a > $b ? "a ($a) is greater" : ($a < $b ? "b ($b) is greater" : "a equals b"))
    : "Non-numeric comparison"
  ) . "<br>";
  echo "================ <br>";

  // Null coalescing operator with fallback
  $c = null;
  echo "Null coalescing operator (c ?? 'default'): " . ($c ?? 'default') . "<br>";
  echo "================ <br>";
}
