<?php
// functions.php
require_once __DIR__ . '/helpers/session.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';

class Crud
{
  private $conn;
  private $auth;

  public function __construct()
  {
    global $db;
    $this->conn = $db->getConnection();
    $this->auth = new Auth();
  }

  public function getItemById(int $id): ?array
  {
    if (!$this->auth->isLoggedIn()) return null;
    $userId = $_SESSION['user_id'];

    $stmt = $this->conn->prepare("SELECT * FROM items WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    return $item ?: null;
  }

  public function getSortedData(string $sortBy = 'id', string $sortOrder = 'asc', string $searchTerm = '', int $limit = 10, int $offset = 0): array
  {
    if (!$this->auth->isLoggedIn()) return [];

    $userId = $_SESSION['user_id'];

    $allowedSortBy = ['id', 'name', 'value'];
    $allowedSortOrder = ['asc', 'desc'];
    $sortBy = in_array($sortBy, $allowedSortBy) ? $sortBy : 'id';
    $sortOrder = in_array(strtolower($sortOrder), $allowedSortOrder) ? $sortOrder : 'asc';

    if ($searchTerm) {
      $sql = "SELECT * FROM items WHERE user_id = :userId AND name LIKE :searchTerm ORDER BY $sortBy $sortOrder LIMIT :limit OFFSET :offset";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
      $stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
    } else {
      $sql = "SELECT * FROM items WHERE user_id = :userId ORDER BY $sortBy $sortOrder LIMIT :limit OFFSET :offset";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTotalItemCount(): int
  {
    if (!$this->auth->isLoggedIn()) return 0;
    $userId = $_SESSION['user_id'];
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM items WHERE user_id = ?");
    $stmt->execute([$userId]);
    return (int)$stmt->fetchColumn();
  }

  public function validateItem(array $data): array
  {
    $errors = [];
    $name = $data['name'];
    $value = $data['value'];

    if (empty($name)) {
      $errors['name'] = 'Name is required';
    }
    if ($value < 0) {
      $errors['value'] = 'Value must be a non-negative number';
    }
    if ($value > 999999.99) {
      $errors['value'] = 'Value is too large. Maximum allowed is 999999.99';
    }
    return $errors;
  }

  public function saveItem(array $data): bool
  {
    if (!$this->auth->isLoggedIn()) return false;
    $userId = $_SESSION['user_id'];
    $name = $data['name'];
    $value = $data['value'];
    $id = $data['id'] ?? null;

    $errors = $this->validateItem($data);
    if (!empty($errors)) {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
      $_SESSION['errors'] = $errors;
      return false;
    }

    if ($id) {
      $stmt = $this->conn->prepare("UPDATE items SET name = ?, value = ? WHERE id = ? AND user_id = ?");
      $success = $stmt->execute([$name, $value, $id, $userId]);
    } else {
      $stmt = $this->conn->prepare("INSERT INTO items (name, value, user_id) VALUES (?, ?, ?)");
      $success = $stmt->execute([$name, $value, $userId]);
    }

    return $success;
  }

  public function deleteItem(int $id): bool
  {
    if (!$this->auth->isLoggedIn()) return false;
    $userId = $_SESSION['user_id'];
    $stmt = $this->conn->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
    $success = $stmt->execute([$id, $userId]);
    $success = $stmt->execute();
    return $success;
  }
}
