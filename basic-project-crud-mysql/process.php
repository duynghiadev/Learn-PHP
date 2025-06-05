<?php

declare(strict_types=1);

require_once 'config.php';
require_once 'functions.php';

if (!isAuthenticated()) {
  header("Location: login.php");
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
    if (!isset($_POST['action'])) {
      throw new AdvancedFunctionException('No action specified');
    }

    $action = $_POST['action'];

    try {
      match ($action) {
        'create' => $this->handleCreate(),
        'update' => $this->handleUpdate(),
        'delete' => $this->handleDelete(),
        default => throw new AdvancedFunctionException("Invalid action: $action")
      };

      if (!empty($this->errors)) {
        $_SESSION['errors'] = $this->errors;
      }

      header('Location: index.php');
      exit;
    } catch (AdvancedFunctionException $e) {
      $_SESSION['errors']['general'] = $e->getMessage();
      header('Location: index.php');
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
