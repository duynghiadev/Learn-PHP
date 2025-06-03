<?php

function compareValues($a, $b)
{
  // Strict equality comparison
  if ($a === $b) {
    echo "a === b <br>";
  } else {
    echo "a !== b <br>";
  }
  echo "================ <br>";

  // Loose equality comparison
  if ($a == $b) {
    echo "a == b <br>";
  } else {
    echo "a != b <br>";
  }
  echo "================ <br>";

  // Not equal comparison
  if ($a != $b) {
    echo "a != b <br>";
  } else {
    echo "a == b <br>";
  }
  echo "================ <br>";

  // Strict not equal comparison
  if ($a !== $b) {
    echo "a !== b <br>";
  } else {
    echo "a === b <br>";
  }
  echo "================ <br>";

  // Less than comparison
  if ($a < $b) {
    echo "a < b <br>";
  } else {
    echo "a >= b <br>";
  }
  echo "================ <br>";

  // Greater than comparison
  if ($a > $b) {
    echo "a > b <br>";
  } else {
    echo "a <= b <br>";
  }
  echo "================ <br>";

  // Less than or equal comparison
  if ($a <= $b) {
    echo "a <= b <br>";
  } else {
    echo "a > b <br>";
  }
  echo "================ <br>";

  // Greater than or equal comparison
  if ($a >= $b) {
    echo "a >= b <br>";
  } else {
    echo "a < b <br>";
  }
  echo "================ <br>";

  // Logical AND
  if ($a && $b) {
    echo "a && b <br>";
  } else {
    echo "a || b <br>";
  }
  echo "================ <br>";

  // Logical OR
  if ($a || $b) {
    echo "a || b <br>";
  } else {
    echo "a && b <br>";
  }
  echo "================ <br>";

  // Logical NOT
  if (!$a) {
    echo "!a <br>";
  } else {
    echo "a <br>";
  }
  echo "================ <br>";

  if (!$b) {
    echo "!b <br>";
  } else {
    echo "b <br>";
  }
  echo "================ <br>";

  // Pre-increment
  echo "Pre-increment ++a: " . (++$a) . "<br>";
  echo "================ <br>";

  // Post-increment
  echo "Post-increment a++: " . ($a++) . "<br>";
  echo "a after post-increment: " . $a . "<br>";
  echo "================ <br>";

  // Pre-decrement
  echo "Pre-decrement --b: " . (--$b) . "<br>";
  echo "================ <br>";

  // Post-decrement
  echo "Post-decrement b--: " . ($b--) . "<br>";
  echo "b after post-decrement: " . $b . "<br>";
  echo "================ <br>";
}

// Example usage
$a = 5;
$b = 3;
compareValues($a, $b);
