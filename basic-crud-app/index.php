<?php
// File: index.php
declare(strict_types=1);

require_once '../basic-php/advanced_function_examples.php';
require_once 'functions.php';

session_start();

// Initialize data store if not set
if (!isset($_SESSION['dataStore'])) {
  $_SESSION['dataStore'] = [
    1 => ['id' => 1, 'name' => 'SAMPLE ITEM', 'value' => 10.5]
  ];
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$editItem = null;
if (isset($_GET['edit_id'])) {
  $editItem = getItemById((int)$_GET['edit_id']);
}

// Sorting
$sortBy = $_GET['sort_by'] ?? 'id';
$sortOrder = $_GET['sort_order'] ?? 'asc';
$searchQuery = $_GET['search'] ?? '';
$data = getSortedData($sortBy, $sortOrder, $searchQuery);
transformForDisplay($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CRUD Application</title>
  <link rel="stylesheet" href="styles.css?v=2">
</head>

<body>
  <div class="container">
    <h1>CRUD Application</h1>

    <!-- Error Display -->
    <?php if (isset($errors['general'])): ?>
      <p class="error"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>

    <!-- Search Form -->
    <form action="index.php" method="GET" class="search-form">
      <label for="search">Search Items</label>
      <input type="text" name="search" id="search" value="<?= htmlspecialchars($searchQuery) ?>" placeholder="Search by name or value">
      <button type="submit" class="search-submit">Search</button>
      <?php if ($searchQuery): ?>
        <a href="index.php" class="clear-search">Clear Search</a>
      <?php endif; ?>
    </form>

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
        <input type="number" name="value" id="value" step="0.01" required
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
    <h2>Items <?= $searchQuery ? " (Search: " . htmlspecialchars($searchQuery) . ")" : "" ?></h2>
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
  </div>
</body>

</html>