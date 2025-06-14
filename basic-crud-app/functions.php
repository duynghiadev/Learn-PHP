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
 * @param string $searchQuery Search query to filter items
 * @return array Sorted and filtered data array
 */
function getSortedData(string $sortBy, string $sortOrder, string $searchQuery = ''): array
{
  $data = $_SESSION['dataStore'] ?? [];

  // Filter data based on search query
  if ($searchQuery !== '') {
    $searchQuery = strtolower(trim($searchQuery));
    $data = array_filter($data, function ($item) use ($searchQuery) {
      return stripos($item['name'], $searchQuery) !== false ||
        stripos((string)$item['value'], $searchQuery) !== false;
    });
  }

  // Sort the filtered data
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
  if (trim($item['name'] ?? '') === '') {
    $errors['name'] = 'Name is required';
    $isValid = false;
  }

  if (!isset($item['value']) || trim((string)$item['value']) === '') {
    $errors['value'] = 'Value is required';
    $isValid = false;
  } elseif (!is_numeric($item['value']) || (float)$item['value'] < 0) {
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

/**
 * Validates user credentials
 *
 * @param string $username
 * @param string $password
 * @return bool
 */
function validateUser(string $username, string $password): bool
{
  $users = $_SESSION['users'] ?? [];
  return isset($users[$username]) && password_verify($password, $users[$username]['password']);
}

/**
 * Creates a new user
 *
 * @param string $username
 * @param string $password
 * @return bool
 */
function createUser(string $username, string $password): bool
{
  if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
  }

  if (isset($_SESSION['users'][$username])) {
    return false;
  }

  $_SESSION['users'][$username] = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT)
  ];

  // Lưu vào local storage qua cookie để đồng bộ client-side
  setcookie('user_data', json_encode(['username' => $username]), time() + (7 * 24 * 3600), '/');
  return true;
}

/**
 * Generates a user token
 *
 * @param string $username
 * @return string
 */
function generateUserToken(string $username): string
{
  $token = bin2hex(random_bytes(16));
  $_SESSION['tokens'][$token] = [
    'username' => $username,
    'expires' => time() + (7 * 24 * 3600) // 7 days
  ];
  return $token;
}

/**
 * Verifies a user token
 *
 * @param string $token
 * @return bool
 */
function verifyUserToken(string $token): bool
{
  return isset($_SESSION['tokens'][$token]) &&
    $_SESSION['tokens'][$token]['expires'] > time();
}

/**
 * Gets user by token
 *
 * @param string $token
 * @return array|null
 */
function getUserByToken(string $token): ?array
{
  return $_SESSION['tokens'][$token] ?? null;
}
