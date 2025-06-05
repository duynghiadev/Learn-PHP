<?php
// index.php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/functions.php';

session_start();
$auth = new Auth();
if (!$auth->isLoggedIn()) {
  header("Location: login.php");
  exit;
}

$crud = new Crud();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$editItem = null;
if (isset($_GET['edit_id'])) {
  $editItem = $crud->getItemById((int)$_GET['edit_id']);
}

$sortBy = $_GET['sort_by'] ?? 'id';
$sortOrder = $_GET['sort_order'] ?? 'asc';
$data = $crud->getSortedData($sortBy, $sortOrder);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CRUD Application</title>
  <style>
    body {
      background-color: #f4f7fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 28px;
      font-weight: 600;
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }

    h2 {
      font-size: 22px;
      font-weight: 500;
      color: #444;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #555;
      margin-bottom: 8px;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
      border-color: #4a6de5;
      outline: none;
    }

    .error {
      color: #e63946;
      font-size: 12px;
      margin-top: 6px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #4a6de5;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #3a55b8;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 14px 16px;
      text-align: left;
      font-size: 14px;
    }

    th {
      background-color: #f8f9fa;
      color: #666;
      text-transform: uppercase;
      font-size: 12px;
      font-weight: 600;
      border-bottom: 2px solid #e9ecef;
    }

    td {
      color: #333;
      border-bottom: 1px solid #e9ecef;
    }

    .no-items {
      color: #888;
      font-size: 14px;
      text-align: center;
      padding: 20px;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
      align-items: center;
      justify-content: center;
    }

    .action-buttons a,
    .action-buttons button {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 80px;
      height: 40px;
      padding: 0;
      text-align: center;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s;
      text-transform: uppercase;
    }

    .action-buttons a {
      background-color: #4a6de5;
      color: white;
    }

    .action-buttons a:hover {
      background-color: #3a55b8;
    }

    .action-buttons button {
      background-color: #e63946;
      color: white;
      border: none;
    }

    .action-buttons button:hover {
      background-color: #b32b35;
    }

    .logout-button {
      margin-top: 20px;
      text-align: center;
    }

    .logout-button button {
      width: auto;
      padding: 10px 20px;
      background-color: #6c757d;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      transition: background-color 0.3s;
    }

    .logout-button button:hover {
      background-color: #5a6268;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>CRUD Application</h1>

    <!-- Create/Edit Form -->
    <form action="process.php" method="POST" class="form-group">
      <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$editItem['id']) ?>">
      <?php endif; ?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name"
          value="<?= htmlspecialchars($editItem['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
          <p class="error"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="value">Value</label>
        <input type="number" name="value" id="value" step="0.01"
          value="<?= htmlspecialchars((string)($editItem['value'] ?? '')) ?>">
        <?php if (isset($errors['value'])): ?>
          <p class="error"><?= htmlspecialchars($errors['value']) ?></p>
        <?php endif; ?>
      </div>
      <button type="submit" name="action" value="<?= $editItem ? 'update' : 'create' ?>">
        <?= $editItem ? 'Update' : 'Create' ?> Item
      </button>
    </form>

    <!-- Data Table -->
    <h2>Items</h2>
    <?php if (empty($data)): ?>
      <p class="no-items">No items found.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>
              <a href="?sort_by=id&sort_order=<?= $sortBy === 'id' && $sortOrder === 'asc' ? 'desc' : 'asc' ?>">
                ID <?= $sortBy === 'id' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' ?>
              </a>
            </th>
            <th>
              <a href="?sort_by=name&sort_order=<?= $sortBy === 'name' && $sortOrder === 'asc' ? 'desc' : 'asc' ?>">
                Name <?= $sortBy === 'name' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' ?>
              </a>
            </th>
            <th>
              <a href="?sort_by=value&sort_order=<?= $sortBy === 'value' && $sortOrder === 'asc' ? 'desc' : 'asc' ?>">
                Value <?= $sortBy === 'value' ? ($sortOrder === 'asc' ? '↑' : '↓') : '' ?>
              </a>
            </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $item): ?>
            <tr>
              <td><?= htmlspecialchars((string)$item['id']) ?></td>
              <td><?= htmlspecialchars($item['display_name']) ?></td>
              <td><?= htmlspecialchars((string)$item['value']) ?></td>
              <td>
                <div class="action-buttons">
                  <a href="?edit_id=<?= htmlspecialchars((string)$item['id']) ?>">Edit</a>
                  <form action="process.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$item['id']) ?>">
                    <button type="submit" name="action" value="delete"
                      onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- Logout Button -->
    <div class="logout-button">
      <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>
</body>

</html>