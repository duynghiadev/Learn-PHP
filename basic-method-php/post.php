<?php

declare(strict_types=1); // Enable strict typing

require_once '../basic-php/advanced_function_examples.php'; // Import DataContainer and functions

// Simulated in-memory data store
static $dataStore = [
  1 => ['id' => 1, 'name' => 'Item 1', 'value' => 10.5],
  2 => ['id' => 2, 'name' => 'Item 2', 'value' => 20.0]
];

// Function to handle POST request (value type processing)
function handlePostRequest(string $name, float $value): array
{
  global $dataStore;
  $id = max(array_keys($dataStore)) + 1;
  $dataStore[$id] = ['id' => $id, 'name' => $name, 'value' => $value];
  return ['status' => 'success', 'data' => $dataStore[$id]];
}

// Anonymous function to validate POST data (reference type)
$validatePostData = function (array &$data) use (&$validatePostData): DataContainer {
  if (!isset($data['name']) || !is_string($data['name']) || empty($data['name'])) {
    throw new AdvancedFunctionException('Invalid or missing name');
  }
  if (!isset($data['value']) || !is_numeric($data['value'])) {
    throw new AdvancedFunctionException('Invalid or missing value');
  }
  $data['value'] = (float)$data['value'];
  return new DataContainer($data['name'], 1);
};

// Main script
header('Content-Type: application/json');
try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new AdvancedFunctionException('Method not allowed, use POST');
  }

  $input = json_decode(file_get_contents('php://input'), true);
  if (json_last_error() !== JSON_ERROR_NONE) {
    throw new AdvancedFunctionException('Invalid JSON input');
  }

  $object = $validatePostData($input);
  $response = handlePostRequest($input['name'], $input['value']);

  echo json_encode([
    'response' => $response,
    'validated' => "POST data validated: $object"
  ]);
} catch (AdvancedFunctionException $e) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Internal server error']);
}
