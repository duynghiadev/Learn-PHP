<?php
// includes/auth.php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../config/db.php';

class Auth
{
  private $conn;

  public function __construct()
  {
    global $db;
    $this->conn = $db->getConnection();
  }

  /**
   * Validates email format and checks for uniqueness.
   */
  private function validateEmail(string $email, bool $checkUnique = true): array
  {
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format";
    }
    if ($checkUnique) {
      $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
      $stmt->execute([$email]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (count($result) > 0) {
        $errors[] = "Email already registered";
      }
    }
    return $errors;
  }

  /**
   * Validates password with at least one uppercase letter.
   */
  private function validatePassword(string $password): array
  {
    $errors = [];
    if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters long";
    }
    if (!preg_match("/[A-Z]/", $password)) {
      $errors[] = "Password must contain at least one uppercase letter";
    }
    return $errors;
  }

  /**
   * Registers a new user.
   */
  public function register(string $email, string $password, string $confirmPassword): array
  {
    $errors = array_merge(
      $this->validateEmail($email),
      $this->validatePassword($password)
    );

    if ($password !== $confirmPassword) {
      $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $this->conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
      $success = $stmt->execute([$email, $hashedPassword]);

      if (!$success) {
        $errors[] = "Failed to register user";
      }
    }

    return $errors;
  }

  /**
   * Logs in a user.
   */
  public function login(string $email, string $password): ?array
  {
    $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
      $_SESSION['user_id'] = $user['id'];
      return ['success' => true];
    }
    return ['success' => false, 'message' => 'Invalid email or password'];
  }

  /**
   * Checks if user is logged in.
   */
  public function isLoggedIn(): bool
  {
    safe_session_start();
    return isset($_SESSION['user_id']);
  }

  /**
   * Logs out the user.
   */
  public function logout()
  {
    safe_session_start();
    session_destroy();
    header("Location: login.php");
    exit;
  }
}
