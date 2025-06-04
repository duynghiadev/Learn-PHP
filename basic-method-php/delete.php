<?php

declare(strict_types=1); // Enable strict typing

require_once '../basic-php/advanced_function_examples.php'; // Import DataContainer and functions

// Simulated in-memory data store
static $dataStore = [
  1 => ['id' => 1, 'name' => 'Item 1', 'value' => 10.5],
  2 => ['id' => 2, 'name' => 'Item 2', 'value' => 20.0]
];

// Function to handle DELETE request (value type processing)
function handleDeleteRequest(int $id): array
{
  global $dataStore;
  if (!isset($dataStore[$id])) {
    throw new AdvancedFunctionException("Item with ID $id not found");
  }
  $deleted = $dataStore[$id];
  unset($dataStore[$id]);
  return ['status' => 'success', 'data' => $deleted];
}

// Anonymous function to log deletion (reference type)
$logDeletion = function (array $deletedData) use (&$logDeletion): DataContainer {
  $name = $deletedData['name'] ?? 'Unknown';
  $counter = isset($deletedData['id']) ? (int)$deletedData['id'] : 0;
  return new DataContainer("Deleted_$name", $counter);
};

// Main script
header('Content-Type: application/json');
try {
  if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    throw new AdvancedFunctionException('Method not allowed, use DELETE');
  }

  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  if ($id <= 0) {
    throw new AdvancedFunctionException('Invalid ID');
  }

  $response = handleDeleteRequest($id);
  $object = $logDeletion($response['data']);

  echo json_encode([
    'response' => $response,
    'logged' => "Deletion logged: $object"
  ]);
} catch (AdvancedFunctionException $e) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
}
