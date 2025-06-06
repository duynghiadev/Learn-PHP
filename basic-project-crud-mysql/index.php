<?php
// index.php
require_once __DIR__ . '/helpers/session.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/functions.php';

safe_session_start();
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
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="container">
    <h1>CRUD Application</h1>

    <!-- Create/Edit Form -->
    <form action="process.php" method="POST" class="form-group" id="crud-form">
      <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$editItem['id']) ?>">
      <?php endif; ?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name"
          value="<?= htmlspecialchars($editItem['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
          <p class="error server-error"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>
        <p class="error" id="name-error">Name is required</p>
      </div>
      <div class="form-group">
        <label for="value">Value</label>
        <input type="number" name="value" id="value" step="0.01"
          value="<?= htmlspecialchars((string)($editItem['value'] ?? '')) ?>">
        <?php if (isset($errors['value'])): ?>
          <p class="error server-error"><?= htmlspecialchars($errors['value']) ?></p>
        <?php endif; ?>
        <p class="error" id="value-error">Value is required</p>
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

  <script src="./js/script.js"></script>
</body>

</html>