<?php

declare(strict_types=1); // Enable strict typing for production-grade code

// Custom exception for advanced function errors
class AdvancedFunctionException extends Exception {}

// Function with parameters: Curried function for chained comparisons
function curryCompare(callable $comparison, mixed ...$initialArgs): callable
{
  return function (mixed ...$args) use ($comparison, $initialArgs): string {
    $allArgs = array_merge($initialArgs, $args);
    if (count($allArgs) < 2) {
      throw new AdvancedFunctionException("At least two arguments required for comparison");
    }
    $result = $comparison($allArgs[0], $allArgs[1]);
    return sprintf(
      "Curried comparison (%s vs %s): %s",
      $allArgs[0],
      $allArgs[1],
      $result ? "true" : "false"
    );
  };
}

// Function with parameters: Memoized calculation with variadic args
function memoizedCalculate(string $operation, float ...$numbers): float
{
  static $cache = [];
  $cacheKey = $operation . ':' . implode(',', $numbers);

  if (isset($cache[$cacheKey])) {
    return $cache[$cacheKey];
  }

  $result = match ($operation) {
    'sum' => array_sum($numbers),
    'product' => array_product($numbers),
    'max' => !empty($numbers) ? max($numbers) : throw new AdvancedFunctionException("No numbers provided"),
    'min' => !empty($numbers) ? min($numbers) : throw new AdvancedFunctionException("No numbers provided"),
    default => throw new AdvancedFunctionException("Unsupported operation: $operation")
  };

  $cache[$cacheKey] = $result;
  return $result;
}

// Function with parameters: Object transformation with callback
function transformData(array $data, callable $transformer, bool $preserveKeys = true): array
{
  $result = [];
  foreach ($data as $key => $value) {
    try {
      $transformed = $transformer($value, $key);
      if ($preserveKeys) {
        $result[$key] = $transformed;
      } else {
        $result[] = $transformed;
      }
    } catch (TypeError $e) {
      throw new AdvancedFunctionException("Transformation failed: " . $e->getMessage());
    }
  }
  return $result;
}

// Function without parameters: Singleton-like configuration reader
function getSystemConfig(): array
{
  static $config = null;
  if ($config === null) {
    // Simulate fetching config (no I/O, so using static data)
    $config = [
      'environment' => 'production',
      'debug' => false,
      'timestamp' => date('Y-m-d H:i:s', time()) // Using current time: 04:40 PM +07, June 03, 2025
    ];
  }
  return $config;
}

// Function without parameters: Counter with static state
function getNextId(): int
{
  static $id = 0;
  return ++$id;
}

// Function without parameters: Generate random operation log
function generateOperationLog(): string
{
  static $operations = [];
  $operations[] = sprintf(
    "Operation #%d at %s",
    getNextId(),
    getSystemConfig()['timestamp']
  );
  return end($operations);
}

// Function with parameters: Advanced match expression for type-based processing
function processValue(mixed $value, string $mode = 'strict'): string
{
  return match ($mode) {
    'strict' => match (true) {
      is_int($value) => "Strict: Integer ($value), squared: " . ($value ** 2),
      is_float($value) => "Strict: Float ($value), formatted: " . number_format($value, 2),
      is_string($value) => "Strict: String ($value), hash: " . md5($value),
      is_array($value) => "Strict: Array, count: " . count($value),
      default => throw new AdvancedFunctionException("Unsupported type in strict mode: " . gettype($value))
    },
    'loose' => "Loose: Value ($value), type: " . gettype($value),
    default => throw new AdvancedFunctionException("Invalid mode: $mode")
  };
}
