<?php

declare(strict_types=1); // Enable strict typing for production-grade code

// Custom exception for advanced function errors
if (!class_exists('AdvancedFunctionException')) {
  class AdvancedFunctionException extends Exception {}
}

// Custom class for reference type demonstration
if (!class_exists('DataContainer')) {
  class DataContainer
  {
    public function __construct(public string $data, public int $counter = 0) {}

    public function increment(): void
    {
      $this->counter++;
    }

    public function __toString(): string
    {
      return "Data: {$this->data}, Counter: {$this->counter}";
    }
  }
}

// Function with parameters: Curried function for chained comparisons
if (!function_exists('curryCompare')) {
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
}

// Function with parameters: Memoized calculation with variadic args
if (!function_exists('memoizedCalculate')) {
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
}

// Function with parameters: Object transformation with callback
if (!function_exists('transformData')) {
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
}

// Function without parameters: Singleton-like configuration reader
if (!function_exists('getSystemConfig')) {
  function getSystemConfig(): array
  {
    static $config = null;
    if ($config === null) {
      // Simulate fetching config (no I/O, so using static data)
      $config = [
        'environment' => 'production',
        'debug' => false,
        'timestamp' => '2025-06-04 09:54:00' // Updated to 09:54 AM +07, June 04, 2025
      ];
    }
    return $config;
  }
}

// Function without parameters: Counter with static state
if (!function_exists('getNextId')) {
  function getNextId(): int
  {
    static $id = 0;
    return ++$id;
  }
}

// Function without parameters: Generate random operation log
if (!function_exists('generateOperationLog')) {
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
}

// Function with parameters: Advanced match expression for type-based processing
if (!function_exists('processValue')) {
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
}

// Function with parameters: Process value type (pass-by-value)
if (!function_exists('processValueType')) {
  function processValueType(mixed $value): string
  {
    $originalValue = $value; // Store original for comparison
    if (is_scalar($value)) {
      $value = match (gettype($value)) {
        'integer' => $value + 10,
        'double' => $value * 2.0,
        'string' => strtoupper($value),
        'boolean' => !$value,
        default => $value
      };
      return "Value type processed: Original: $originalValue, Modified: $value, Type: " . gettype($value);
    } elseif (is_array($value)) {
      $value[] = 'modified'; // Attempt to modify array
      return "Array type processed: Original count: " . count($originalValue) . ", Modified count: " . count($value);
    }
    throw new AdvancedFunctionException("Unsupported value type: " . gettype($value));
  }
}

// Function with parameters: Process reference type (pass-by-reference for scalar/array, object by default)
if (!function_exists('processReferenceType')) {
  function processReferenceType(mixed &$value, DataContainer $object): string
  {
    $originalValue = $value;
    if (is_scalar($value) || is_array($value)) {
      $value = is_array($value) ? array_merge($value, ['referenced']) : ($value . '_ref');
      $object->increment(); // Mutate object
      return "Reference type processed: Original: $originalValue, Modified: $value, Object: $object";
    }
    throw new AdvancedFunctionException("Value must be scalar or array for reference processing");
  }
}

// Function without parameters: Create and return a new object (reference type)
if (!function_exists('createDataObject')) {
  function createDataObject(): DataContainer
  {
    static $counter = 0;
    return new DataContainer("Object_" . ++$counter);
  }
}

// Function with parameters: Clone object to avoid mutation (reference type handling)
if (!function_exists('safeObjectProcess')) {
  function safeObjectProcess(DataContainer $object, callable $modifier): string
  {
    $cloned = clone $object; // Clone to avoid modifying original
    $modifier($cloned);
    return "Safe object processing: Original: $object, Modified: $cloned";
  }
}

// Anonymous function: Transform value type with dynamic operation
if (!isset($transformValueType)) {
  $transformValueType = function (mixed $value, string $operation = 'default'): string {
    $originalValue = $value;
    if (is_scalar($value)) {
      $value = match ($operation) {
        'increment' => is_numeric($value) ? $value + 1 : $value,
        'reverse' => is_string($value) ? strrev($value) : $value,
        'negate' => is_bool($value) ? !$value : $value,
        'default' => $value,
        default => throw new AdvancedFunctionException("Invalid operation: $operation")
      };
      return "Anonymous value type transform: Original: $originalValue, Operation: $operation, Result: $value";
    } elseif (is_array($value)) {
      $value = array_map(fn($item) => is_numeric($item) ? $item * 2 : $item, $value);
      return "Anonymous array transform: Original count: " . count($originalValue) . ", Modified count: " . count($value);
    }
    throw new AdvancedFunctionException("Unsupported value type: " . gettype($value));
  };
}

// Anonymous function: Modify reference type (object and pass-by-reference)
if (!isset($modifyReferenceType)) {
  $modifyReferenceType = function (mixed &$value, DataContainer $object) use (&$transformValueType): string {
    $originalValue = $value;
    if (is_scalar($value) || is_array($value)) {
      $value = is_array($value) ? array_merge($value, ['anon_ref']) : ($value . '_anon_ref');
      $object->increment();
      // Use another anonymous function to transform value
      $transformed = $transformValueType($value, 'default');
      return "Anonymous reference type modify: Original: $originalValue, Modified: $value, Object: $object, Transformed: $transformed";
    }
    throw new AdvancedFunctionException("Value must be scalar or array for reference processing");
  };
}

// Anonymous function: Higher-order function to process with custom anonymous logic
if (!isset($processWithCustomLogic)) {
  $processWithCustomLogic = function (mixed $input, callable $processor): string {
    static $callCount = 0;
    $callCount++;
    try {
      $result = $processor($input);
      return "Higher-order anonymous process #$callCount: Input: $input, Result: $result";
    } catch (TypeError $e) {
      throw new AdvancedFunctionException("Processing failed: " . $e->getMessage());
    }
  };
}
