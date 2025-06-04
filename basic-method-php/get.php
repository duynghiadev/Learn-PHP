<?php

declare(strict_types=1); // Enable strict typing

require_once '../basic-php/advanced_function_examples.php'; // Import DataContainer and functions

// Simulated in-memory data store
static $dataStore = [
  1 => ['id' => 1, 'name' => 'Item 1', 'value' => 10.5],
  2 => ['id' => 2, 'name' => 'Item 2', 'value' => 20.0]
];

// Function to handle GET request (value type processing)
function handleGetRequest(int $id = 0): array
{
  global $dataStore;
  if ($id === 0) {
    return ['status' => 'success', 'data' => array_values($dataStore)];
  }
  if (isset($dataStore[$id])) {
    return ['status' => 'success', 'data' => $dataStore[$id]];
  }
  throw new AdvancedFunctionException("Item with ID $id not found");
}

// Anonymous function to process GET response (reference type)
$processGetResponse = function (array $response): DataContainer {
  $data = $response['data'];
  $name = is_array($data) && isset($data['name']) ? $data['name'] : 'Unknown';
  $counter = is_array($data) && isset($data['value']) ? (int)$data['value'] : 0;
  return new DataContainer($name, $counter);
};

// Main script
header('Content-Type: application/json');
try {
  if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    throw new AdvancedFunctionException('Method not allowed, use GET');
  }

  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $response = handleGetRequest($id);
  $object = $processGetResponse($response);

  echo json_encode([
    'response' => $response,
    'processed' => "GET response as object: $object"
  ]);
} catch (AdvancedFunctionException $e) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
}
