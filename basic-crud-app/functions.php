<?php
// File: functions.php
declare(strict_types=1);

require_once '../basic-php/advanced_function_examples.php';

/**
 * Retrieves an item by ID from the data store.
 *
 * @param int $id The ID of the item to retrieve
 * @return array|null The item if found, null otherwise
 */
function getItemById(int $id): ?array
{
  return $_SESSION['dataStore'][$id] ?? null;
}

/**
 * Sorts the data store based on a field and order.
 *
 * @param string $sortBy Field to sort by
 * @param string $sortOrder 'asc' or 'desc'
 * @return array Sorted data array
 */
function getSortedData(string $sortBy, string $sortOrder): array
{
  $data = $_SESSION['dataStore'] ?? [];
  usort($data, function ($a, $b) use ($sortBy, $sortOrder) {
    $valueA = $a[$sortBy];
    $valueB = $b[$sortBy];
    $result = is_numeric($valueA) ? ($valueA <=> $valueB) : strcmp((string)$valueA, (string)$valueB);
    return $sortOrder === 'asc' ? $result : -$result;
  });
  return $data;
}

/**
 * Transforms data for display by adding a display_name field.
 *
 * @param array $items Items to transform
 * @return DataContainer Transformation result container
 */
function transformForDisplay(array &$items): DataContainer
{
  foreach ($items as &$item) {
    $item['display_name'] = ucwords(strtolower($item['name']));
  }
  unset($item);
  return new DataContainer('Transformed_Data', count($items));
}

/**
 * Validates an item before create or update.
 *
 * @param array $item Item data to validate
 * @param array $errors Reference to store validation errors
 * @return bool True if valid, false otherwise
 */
function validateItem(array $item, array &$errors): bool
{
  $isValid = true;
  if (empty($item['name'])) {
    $errors['name'] = 'Name is required';
    $isValid = false;
  }
  if (!is_numeric($item['value']) || (float)$item['value'] < 0) {
    $errors['value'] = 'Value must be a non-negative number';
    $isValid = false;
  }
  return $isValid;
}

/**
 * Sanitizes and prepares item data for storage.
 *
 * @param array $input Raw input data
 * @return array Sanitized item data
 */
function sanitizeItem(array $input): array
{
  return [
    'name' => strtoupper(trim($input['name'] ?? '')),
    'value' => (float)($input['value'] ?? 0)
  ];
}
