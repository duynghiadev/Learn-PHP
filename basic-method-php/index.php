<?php

declare(strict_types=1); // Enable strict typing

// Enable error reporting for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include HTTP method files and advanced_function_examples.php
require_once 'get.php';
require_once 'post.php';
require_once 'put.php';
require_once 'delete.php';
require_once '../basic-php/advanced_function_examples.php';

// Function to simulate HTTP requests (value type processing)
function makeHttpRequest(string $method, string $url, array $data = []): string
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  if (!empty($data)) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  }
  $response = curl_exec($ch);
  if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    throw new AdvancedFunctionException("cURL error: $error");
  }
  curl_close($ch);
  return $response;
}

// Function to process response data (reference type)
function processResponseData(array &$response, DataContainer $object): string
{
  if (!isset($response['response']['data'])) {
    throw new AdvancedFunctionException('Invalid response data');
  }
  $data = $response['response']['data'];
  $object->data = is_array($data) && isset($data['name']) ? $data['name'] : 'Processed';
  $object->increment();
  $response['processed_by_function'] = "Processed: $object";
  return $response['processed_by_function'];
}

// Anonymous function to validate and modify response (reference type)
$validateResponse = function (array &$response) use (&$validateResponse): DataContainer {
  if (!isset($response['response']['status']) || $response['response']['status'] !== 'success') {
    throw new AdvancedFunctionException('Response validation failed');
  }
  $response['validated'] = true;
  return new DataContainer('Validated_Response', 1);
};

// Main script
echo "<h1>HTTP Method Tests</h1><br>";

try {
  echo "=== GET Request (get.php) ===<br>";
  $getResponse = json_decode(makeHttpRequest('GET', 'http://localhost/Learn-PHP/basic-method-php/get.php?id=1'), true);
  $getObject = new DataContainer('GetTest');
  echo "Before processing: Object: $getObject<br>";
  echo processResponseData($getResponse, $getObject) . "<br>";
  echo $validateResponse($getResponse) . "<br>";
  echo "After processing: Object: $getObject<br>";
  echo "<pre>" . htmlspecialchars(json_encode($getResponse, JSON_PRETTY_PRINT)) . "</pre><br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: {$e->getMessage()}<br>";
}
echo "================<br>";

try {
  echo "=== POST Request (post.php) ===<br>";
  $postData = ['name' => 'New Item', 'value' => 30.5];
  $postResponse = json_decode(makeHttpRequest('POST', 'http://localhost/Learn-PHP/basic-method-php/post.php', $postData), true);
  $postObject = new DataContainer('PostTest');
  echo "Before processing: Object: $postObject<br>";
  echo processResponseData($postResponse, $postObject) . "<br>";
  echo $validateResponse($postResponse) . "<br>";
  echo "After processing: Object: $postObject<br>";
  echo "<pre>" . htmlspecialchars(json_encode($postResponse, JSON_PRETTY_PRINT)) . "</pre><br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: {$e->getMessage()}<br>";
}
echo "================<br>";

try {
  echo "=== PUT Request (put.php) ===<br>";
  $putData = ['id' => 1, 'name' => 'Updated Item', 'value' => 15.0];
  $putResponse = json_decode(makeHttpRequest('PUT', 'http://localhost/Learn-PHP/basic-method-php/put.php', $putData), true);
  $putObject = new DataContainer('PutTest');
  echo "Before processing: Object: $putObject<br>";
  echo processResponseData($putResponse, $putObject) . "<br>";
  echo $validateResponse($putResponse) . "<br>";
  echo "After processing: Object: $putObject<br>";
  echo "<pre>" . htmlspecialchars(json_encode($putResponse, JSON_PRETTY_PRINT)) . "</pre><br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: {$e->getMessage()}<br>";
}
echo "================<br>";

try {
  echo "=== DELETE Request (delete.php) ===<br>";
  $deleteResponse = json_decode(makeHttpRequest('DELETE', 'http://localhost/Learn-PHP/basic-method-php/delete.php?id=2'), true);
  $deleteObject = new DataContainer('DeleteTest');
  echo "Before processing: Object: $deleteObject<br>";
  echo processResponseData($deleteResponse, $deleteObject) . "<br>";
  echo $validateResponse($deleteResponse) . "<br>";
  echo "After processing: Object: $deleteObject<br>";
  echo "<pre>" . htmlspecialchars(json_encode($deleteResponse, JSON_PRETTY_PRINT)) . "</pre><br>";
} catch (AdvancedFunctionException $e) {
  echo "Error: {$e->getMessage()}<br>";
}
echo "================<br>";
