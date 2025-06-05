<?php
// functions.php
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
    $stmt->bind_param("ii", $id, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();
    return $item ?: null;
  }

  public function getSortedData(string $sortBy, string $sortOrder): array
  {
    if (!$this->auth->isLoggedIn()) return [];
    $userId = $_SESSION['user_id'];
    $sortBy = in_array($sortBy, ['id', 'name', 'value']) ? $sortBy : 'id';
    $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? $sortOrder : 'asc';
    $stmt = $this->conn->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY $sortBy $sortOrder");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    foreach ($data as &$item) {
      $item['display_name'] = ucwords(strtolower($item['name']));
    }
    unset($item);
    return $data;
  }

  public function saveItem(array $data): bool
  {
    if (!$this->auth->isLoggedIn()) return false;
    $userId = $_SESSION['user_id'];
    $name = $data['name'];
    $value = $data['value'];
    $id = $data['id'] ?? null;

    if ($id) {
      $stmt = $this->conn->prepare("UPDATE items SET name = ?, value = ? WHERE id = ? AND user_id = ?");
      $stmt->bind_param("sdii", $name, $value, $id, $userId);
    } else {
      $stmt = $this->conn->prepare("INSERT INTO items (name, value, user_id) VALUES (?, ?, ?)");
      $stmt->bind_param("sdi", $name, $value, $userId);
    }
    $success = $stmt->execute();
    $stmt->close();
    return $success;
  }

  public function deleteItem(int $id): bool
  {
    if (!$this->auth->isLoggedIn()) return false;
    $userId = $_SESSION['user_id'];
    $stmt = $this->conn->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
  }
}
