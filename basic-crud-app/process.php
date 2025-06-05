<?php
// File: process.php
declare(strict_types=1);

require_once '../basic-php/advanced_function_examples.php';
require_once 'functions.php';

session_start();

// Kiểm tra xác thực
if (!isset($_COOKIE['user_token']) || !verifyUserToken($_COOKIE['user_token'])) {
  header('Content-Type: application/json', true, 401);
  echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
  exit;
}

/**
 * Handles the CRUD operations based on the action.
 */
class CrudHandler
{
  private array $errors = [];
  private array $dataStore;

  public function __construct()
  {
    $this->dataStore = &$_SESSION['dataStore'];
  }

  /**
   * Processes the incoming request.
   *
   * @throws AdvancedFunctionException
   */
  public function process(): void
  {
    // Debug: Log received POST data
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - POST: " . print_r($_POST, true) . "\n", FILE_APPEND);

    if (!isset($_POST['crud_action']) || empty($_POST['crud_action'])) {
      header('Content-Type: application/json', true, 400);
      echo json_encode(['success' => false, 'message' => 'No action specified']);
      exit;
    }

    $action = trim($_POST['crud_action']);

    try {
      match ($action) {
        'create' => $this->handleCreate(),
        'update' => $this->handleUpdate(),
        'delete' => $this->handleDelete(),
        default => throw new AdvancedFunctionException("Invalid action: $action")
      };

      if (!empty($this->errors)) {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['success' => false, 'message' => implode(', ', $this->errors)]);
        exit;
      }

      header('Content-Type: application/json');
      echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful']);
      exit;
    } catch (AdvancedFunctionException $e) {
      header('Content-Type: application/json', true, 400);
      echo json_encode(['success' => false, 'message' => $e->getMessage()]);
      exit;
    }
  }

  /**
   * Handles item creation.
   *
   * @throws AdvancedFunctionException
   */
  private function handleCreate(): void
  {
    $item = sanitizeItem($_POST);
    if (validateItem($item, $this->errors)) {
      $id = max(array_keys($this->dataStore + [0 => null])) + 1;
      $item['id'] = $id;
      $this->dataStore[$id] = $item;
    }
  }

  /**
   * Handles item updates.
   *
   * @throws AdvancedFunctionException
   */
  private function handleUpdate(): void
  {
    $id = (int)($_POST['id'] ?? 0);
    if (!isset($this->dataStore[$id])) {
      throw new AdvancedFunctionException("Item with ID $id not found");
    }
    $item = sanitizeItem($_POST);
    if (validateItem($item, $this->errors)) {
      $item['id'] = $id;
      $this->dataStore[$id] = $item;
    }
  }

  /**
   * Handles item deletion.
   *
   * @throws AdvancedFunctionException
   */
  private function handleDelete(): void
  {
    $id = (int)($_POST['id'] ?? 0);
    if (!isset($this->dataStore[$id])) {
      throw new AdvancedFunctionException("Item with ID $id not found");
    }
    unset($this->dataStore[$id]);
  }
}

$handler = new CrudHandler();
$handler->process();
