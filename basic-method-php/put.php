<?php

declare(strict_types=1); // Enable strict typing

require_once '../basic-php/advanced_function_examples.php'; // Import DataContainer and functions

// Simulated in-memory data store
static $dataStore = [
  1 => ['id' => 1, 'name' => 'Item 1', 'value' => 10.5],
  2 => ['id' => 2, 'name' => 'Item 2', 'value' => 20.0]
];

// Function to handle PUT request (value type processing)
function handlePutRequest(int $id, string $name, float $value): array
{
  global $dataStore;
  if (!isset($dataStore[$id])) {
    throw new AdvancedFunctionException("Item with ID $id not found");
  }
  $dataStore[$id] = ['id' => $id, 'name' => $name, 'value' => $value];
  return ['status' => 'success', 'data' => $dataStore[$id]];
}

// Anonymous function to update object based on PUT data (reference type)
$updateObjectFromPut = function (array $data, DataContainer &$object) use (&$updateObjectFromPut): string {
  if (!isset($data['name']) || !isset($data['value'])) {
    throw new AdvancedFunctionException('Missing name or value in PUT data');
  }
  $object->data = $data['name'];
  $object->increment();
  return "Object updated: $object";
};

// Main script
header('Content-Type: application/json');
try {
  if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    throw new AdvancedFunctionException('Method not allowed, use PUT');
  }

  $input = json_decode(file_get_contents('php://input'), true);
  if (json_last_error() !== JSON_ERROR_NONE) {
    throw new AdvancedFunctionException('Invalid JSON input');
  }

  $id = isset($input['id']) ? (int)$input['id'] : 0;
  if ($id <= 0) {
    throw new AdvancedFunctionException('Invalid ID');
  }

  $object = new DataContainer('Initial');
  $updated = $updateObjectFromPut($input, $object);
  $response = handlePutRequest($id, $input['name'], (float)$input['value']);

  echo json_encode([
    'response' => $response,
    'updated' => $updated
  ]);
} catch (AdvancedFunctionException $e) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
}
