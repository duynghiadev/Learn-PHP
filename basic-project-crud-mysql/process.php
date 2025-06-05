<?php
// process.php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/functions.php';

session_start();

$auth = new Auth();
$crud = new Crud();

if (isset($_POST['action'])) {
  $action = $_POST['action'];
  switch ($action) {
    case 'register':
      $errors = $auth->register($_POST['email'], $_POST['password'], $_POST['confirm_password']);
      if (empty($errors)) {
        header("Location: login.php");
      } else {
        $_SESSION['errors'] = $errors;
        header("Location: register.php");
      }
      exit;
    case 'login':
      $result = $auth->login($_POST['email'], $_POST['password']);
      if ($result['success']) {
        header("Location: index.php");
      } else {
        $_SESSION['errors'] = [$result['message']];
        header("Location: login.php");
      }
      exit;
    case 'create':
    case 'update':
      $data = [
        'id' => $_POST['id'] ?? null,
        'name' => trim($_POST['name'] ?? ''),
        'value' => floatval($_POST['value'] ?? 0)
      ];
      $crud->saveItem($data); // Errors are set in saveItem if validation fails
      header("Location: index.php");
      exit;
    case 'delete':
      $crud->deleteItem((int)$_POST['id']);
      header("Location: index.php");
      exit;
  }
}
