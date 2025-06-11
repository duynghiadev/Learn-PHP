<?php

function compareValues($a, $b)
{
  // Initialize array to store comparison results for foreach
  $results = [];

  // Switch-case for value comparison
  $comparison = null;
  if ($a === $b) {
    $comparison = 'equal';
  } elseif ($a > $b) {
    $comparison = 'greater';
  } elseif ($a < $b) {
    $comparison = 'less';
  }

  switch ($comparison) {
    case 'equal':
      $results[] = "a === b (strict equality, type: " . gettype($a) . ")";
      // Bitwise AND
      if (is_numeric($a) && is_numeric($b)) {
        $results[] = "Bitwise AND (a & b): " . ($a & $b);
      }
      break;
    case 'greater':
      $results[] = "a > b (a: $a, b: $b)";
      // Bitwise XOR
      if (is_numeric($a) && is_numeric($b)) {
        $results[] = "Bitwise XOR (a ^ b): " . ($a ^ $b);
      }
      break;
    case 'less':
      $results[] = "a < b (a: $a, b: $b)";
      // Bitwise OR
      if (is_numeric($a) && is_numeric($b)) {
        $results[] = "Bitwise OR (a | b): " . ($a | $b);
      }
      break;
    default:
      $results[] = "Invalid comparison or non-numeric types";
      break;
  }
  echo "Switch-case (value comparison):<br>";
  foreach ($results as $index => $result) {
    echo "[$index] $result<br>";
  }
  echo "================ <br>";

  // Switch-case for type-based operations
  $type = gettype($a);
  switch ($type) {
    case 'integer':
      $results[] = "a is integer, applying left shift (a << 1): " . (is_numeric($a) ? ($a << 1) : 'N/A');
      break;
    case 'double':
      $results[] = "a is float, applying compound multiplication (a *= 1.5): " . (is_numeric($a) ? ($a *= 1.5) : 'N/A');
      break;
    case 'string':
      $results[] = "a is string, length: " . strlen($a);
      break;
    default:
      $results[] = "Unsupported type for a: $type";
      break;
  }
  echo "Switch-case (type-based operations):<br>";
  foreach ($results as $index => $result) {
    echo "[$index] $result<br>";
  }
  echo "================ <br>";

  // While loop for range-based comparison
  $counter = 0;
  $maxIterations = 3;
  echo "While loop (comparing a and b over $maxIterations iterations):<br>";
  while ($counter < $maxIterations && is_numeric($a) && is_numeric($b)) {
    // Spaceship operator
    $spaceship = $a <=> $b;
    $results[] = "Iteration $counter: Spaceship (a <=> b) = $spaceship (" .
      ($spaceship === 0 ? 'equal' : ($spaceship > 0 ? 'a > b' : 'a < b')) . ")";
    $a += 1; // Compound addition
    $counter++;
  }
  foreach ($results as $index => $result) {
    if (strpos($result, 'Iteration') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Do-while loop for bitwise shift operations
  $shiftCounter = 0;
  $maxShifts = 3;
  $tempA = is_numeric($a) ? $a : 0;
  echo "Do-while loop (bitwise right shift on a):<br>";
  do {
    $results[] = "Shift $shiftCounter: a >> $shiftCounter = " . ($tempA >> $shiftCounter);
    $shiftCounter++;
  } while ($shiftCounter < $maxShifts && is_numeric($tempA));
  foreach ($results as $index => $result) {
    if (strpos($result, 'Shift') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Logical NOT with anonymous function
  $logicalNot = function ($value, $name) {
    return !$value ? "!$name evaluates to true" : "$name evaluates to true";
  };
  echo "Logical NOT operations:<br>";
  $results[] = $logicalNot($a, 'a');
  $results[] = $logicalNot($b, 'b');
  foreach ($results as $index => $result) {
    if (strpos($result, 'evaluates') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Pre-increment with type checking
  if (is_numeric($a)) {
    $results[] = "Pre-increment ++a: " . (++$a) . " (type: " . gettype($a) . ")";
  } else {
    $results[] = "Pre-increment skipped: a is not numeric";
  }
  echo "Increment/Decrement operations:<br>";
  foreach ($results as $index => $result) {
    if (strpos($result, 'increment') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Post-increment with type checking
  if (is_numeric($a)) {
    $results[] = "Post-increment a++: " . ($a++) . ", after: $a (type: " . gettype($a) . ")";
  } else {
    $results[] = "Post-increment skipped: a is not numeric";
  }
  foreach ($results as $index => $result) {
    if (strpos($result, 'Post-increment') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Pre-decrement with type checking
  if (is_numeric($b)) {
    $results[] = "Pre-decrement --b: " . (--$b) . " (type: " . gettype($b) . ")";
  } else {
    $results[] = "Pre-decrement skipped: b is not numeric";
  }
  foreach ($results as $index => $result) {
    if (strpos($result, 'Pre-decrement') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Post-decrement with type checking
  if (is_numeric($b)) {
    $results[] = "Post-decrement b--: " . ($b--) . ", after: $b (type: " . gettype($b) . ")";
  } else {
    $results[] = "Post-decrement skipped: b is not numeric";
  }
  foreach ($results as $index => $result) {
    if (strpos($result, 'Post-decrement') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Complex ternary with explicit parentheses for PHP 8.4.0
  try {
    $complexTernary = (is_numeric($a) && is_numeric($b))
      ? ((($a <=> $b) === 0) ? "a equals b (spaceship operator)" : (($a > $b) ? "a ($a) is greater" : "b ($b) is greater"))
      : "Non-numeric comparison";
    $results[] = "Complex ternary: $complexTernary";
  } catch (TypeError $e) {
    $results[] = "TypeError in ternary: " . $e->getMessage();
  }
  echo "Ternary operation:<br>";
  foreach ($results as $index => $result) {
    if (strpos($result, 'ternary') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";

  // Null coalescing operator with fallback
  $c = null;
  $results[] = "Null coalescing operator (c ?? 'default'): " . ($c ?? 'default');
  echo "Null coalescing operation:<br>";
  foreach ($results as $index => $result) {
    if (strpos($result, 'Null coalescing') !== false) {
      echo "[$index] $result<br>";
    }
  }
  echo "================ <br>";
}
