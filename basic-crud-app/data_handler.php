<?php

declare(strict_types=1); // Enable strict typing

require_once '../basic-php/advanced_function_examples.php';

// Simulated in-memory data store
static $dataStore = [
  1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'age' => 30],
  2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'age' => 25]
];

// Function to validate input (value type processing)
function validateInput(string $name, string $email, int $age): void
{
  if (empty($name) || strlen($name) > 100) {
    throw new AdvancedFunctionException('Name is required and must be 100 characters or less.');
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new AdvancedFunctionException('Invalid email format.');
  }
  if ($age < 1 || $age > 120) {
    throw new AdvancedFunctionException('Age must be between 1 and 120.');
  }
}

// Function to create a record (value type processing)
function createRecord(string $name, string $email, int $age): void
{
  global $dataStore;
  validateInput($name, $email, $age);
  $id = max(array_keys($dataStore)) + 1;
  $dataStore[$id] = ['id' => $id, 'name' => $name, 'email' => $email, 'age' => $age];
}

// Function to update a record (value type processing)
function updateRecord(int $id, string $name, string $email, int $age): void
{
  global $dataStore;
  if (!isset($dataStore[$id])) {
    throw new AdvancedFunctionException("Record with ID $id not found.");
  }
  validateInput($name, $email, $age);
  $dataStore[$id] = ['id' => $id, 'name' => $name, 'email' => $email, 'age' => $age];
}

// Function to delete a record (value type processing)
function deleteRecord(int $id): void
{
  global $dataStore;
  if (!isset($dataStore[$id])) {
    throw new AdvancedFunctionException("Record with ID $id not found.");
  }
  unset($dataStore[$id]);
}

// Function to get a single record (value type processing)
function getRecord(int $id): ?array
{
  global $dataStore;
  return $dataStore[$id] ?? null;
}

// Function to get all records with optional search (value type processing)
function getAllRecords(string $search = ''): array
{
  global $dataStore;
  if (empty($search)) {
    return array_values($dataStore);
  }
  return array_values(array_filter(
    $dataStore,
    fn($record) =>
    stripos($record['name'], $search) !== false || stripos($record['email'], $search) !== false
  ));
}

// Anonymous function to transform record into DataContainer (reference type)
$transformToObject = function (array $record) use (&$transformToObject): DataContainer {
  return new DataContainer($record['name'], $record['age']);
};

// Function to process records with anonymous function (reference type)
function processRecords(array &$records): void
{
  global $transformToObject;
  foreach ($records as &$record) {
    $object = $transformToObject($record);
    $record['object'] = "Transformed: $object";
  }
  unset($record); // Unset reference to avoid issues
}
