<?php
// File: index.php
declare(strict_types=1);

require_once '../basic-php/advanced_function_examples.php';
require_once 'functions.php';

session_start();

// Kiểm tra đăng nhập
if (!isset($_COOKIE['user_token']) || !verifyUserToken($_COOKIE['user_token'])) {
  header('Location: login.php');
  exit;
}

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
  <link rel="stylesheet" href="styles.css?v=3">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>CRUD Application</h1>
      <div class="user-info">
        Welcome, <?= htmlspecialchars(getUserByToken($_COOKIE['user_token'])['username'] ?? 'User') ?>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>

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
    <form action="process.php" method="POST" class="form-group" id="crud-form">
      <?php if ($editItem): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string)$editItem['id']) ?>">
      <?php endif; ?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($editItem['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
          <p class="error"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="value">Value</label>
        <input type="number" name="value" id="value" step="0.01" required value="<?= htmlspecialchars((string)($editItem['value'] ?? '')) ?>">
        <?php if (isset($errors['value'])): ?>
          <p class="error"><?= htmlspecialchars($errors['value']) ?></p>
        <?php endif; ?>
      </div>
      <button type="submit" name="crud_action" value="<?= $editItem ? 'update' : 'create' ?>">
        <?= $editItem ? 'Update' : 'Create' ?> Item
      </button>
    </form>

    <!-- Data Table -->
    <h2>Items <?= $searchQuery ? " (Search: " . htmlspecialchars($searchQuery) . ")" : "" ?></h2>
    <?php if (empty($data)): ?>
      <p class="no-items">No items found.</p>
    <?php else: ?>
      <table id="data-table">
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
                  <form action="process.php" method="POST" style="display: inline;" class="delete-form">
                    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$item['id']) ?>">
                    <button type="submit" name="crud_action" value="delete">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <script>
    // Local Storage handling for data
    function syncToLocalStorage() {
      const data = <?php echo json_encode($data); ?>;
      localStorage.setItem('crudData', JSON.stringify(data));
      // Sync user token
      const userToken = '<?php echo isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : ''; ?>';
      if (userToken) {
        localStorage.setItem('userToken', userToken);
      }
    }

    function loadFromLocalStorage() {
      const storedData = localStorage.getItem('crudData');
      if (storedData) {
        const data = JSON.parse(storedData);
        const tbody = document.querySelector('#data-table tbody');
        if (tbody && !<?php echo json_encode(!empty($data)); ?>) {
          tbody.innerHTML = '';
          data.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                            <td>${item.id}</td>
                            <td>${item.display_name}</td>
                            <td>${item.value}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="?edit_id=${item.id}">Edit</a>
                                    <form action="process.php" method="POST" style="display: inline;" class="delete-form">
                                        <input type="hidden" name="id" value="${item.id}">
                                        <button type="submit" name="crud_action" value="delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        `;
            tbody.appendChild(tr);
          });
        }
      }
    }

    // Toast notifications
    function showToast(message, type = 'info') {
      Toastify({
        text: message,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'error' ? "#dc2626" : "#22c55e",
        className: type
      }).showToast();
    }

    // Form submission handling
    document.querySelector('#crud-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);

      try {
        const response = await fetch('process.php', {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json'
          }
        });

        const result = await response.json();
        if (response.ok && result.success) {
          showToast(result.message || 'Operation successful!', 'success');
          syncToLocalStorage();
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Operation failed!', 'error');
        }
      } catch (error) {
        showToast('Network error occurred!', 'error');
      }
    });

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete this item?')) return;

        const formData = new FormData(form);
        try {
          const response = await fetch('process.php', {
            method: 'POST',
            body: formData,
            headers: {
              'Accept': 'application/json'
            }
          });

          const result = await response.json();
          if (response.ok && result.success) {
            showToast(result.message || 'Item deleted successfully!', 'success');
            syncToLocalStorage();
            setTimeout(() => window.location.reload(), 1000);
          } else {
            showToast(result.message || 'Delete failed!', 'error');
          }
        } catch (error) {
          showToast('Network error occurred!', 'error');
        }
      });
    });

    // Initialize Local Storage
    window.addEventListener('load', () => {
      loadFromLocalStorage();
      syncToLocalStorage();
    });
  </script>
</body>

</html>