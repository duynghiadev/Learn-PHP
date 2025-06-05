<?php

declare(strict_types=1);

require_once 'config.php';

/**
 * Validates email format and checks if it exists.
 *
 * @param string $email
 * @param PDO $pdo
 * @return string|null Error message if invalid, null if valid
 */
function validateEmail(string $email, PDO $pdo): ?string
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return "Invalid email format";
  }
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->fetchColumn() > 0) {
    return "Email already registered";
  }
  return null;
}

/**
 * Validates password (must have at least one uppercase).
 *
 * @param string $password
 * @return string|null Error message if invalid, null if valid
 */
function validatePassword(string $password): ?string
{
  if (strlen($password) < 6) {
    return "Password must be at least 6 characters";
  }
  if (!preg_match('/[A-Z]/', $password)) {
    return "Password must contain at least one uppercase letter";
  }
  return null;
}

/**
 * Authenticates a user.
 *
 * @param string $email
 * @param string $password
 * @param PDO $pdo
 * @return array|null User data if authenticated, null otherwise
 */
function authenticate(string $email, string $password, PDO $pdo): ?array
{
  $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user && password_verify($password, $user['password'])) {
    return $user;
  }
  return null;
}

/**
 * Registers a new user.
 *
 * @param string $email
 * @param string $password
 * @param string $passwordConfirm
 * @param PDO $pdo
 * @return string|null Error message if failed, null if successful
 */
function registerUser(string $email, string $password, string $passwordConfirm, PDO $pdo): ?string
{
  $emailError = validateEmail($email, $pdo);
  if ($emailError) return $emailError;

  $passwordError = validatePassword($password);
  if ($passwordError) return $passwordError;

  if ($password !== $passwordConfirm) {
    return "Passwords do not match";
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
  $stmt->execute([$email, $hashedPassword]);
  return null;
}
