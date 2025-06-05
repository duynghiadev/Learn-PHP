<?php

declare(strict_types=1); // Enable strict typing

// Enable error reporting
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'data_handler.php';
require_once '../basic-php/advanced_function_examples.php';

$errors = [];
$success = '';
$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editRecord = $editId ? getRecord($editId) : null;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$records = getAllRecords($searchQuery);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;
  $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

  try {
    if ($id > 0) {
      // Edit existing record
      updateRecord($id, $name, $email, $age);
      $success = 'Record updated successfully!';
    } else {
      // Create new record
      createRecord($name, $email, $age);
      $success = 'Record created successfully!';
    }
    header('Location: index.php');
    exit;
  } catch (AdvancedFunctionException $e) {
    $errors[] = $e->getMessage();
  }
}

// Handle delete
if (isset($_GET['delete'])) {
  try {
    deleteRecord((int)$_GET['delete']);
    header('Location: index.php');
    exit;
  } catch (AdvancedFunctionException $e) {
    $errors[] = $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Application</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function confirmDelete(id) {
      if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = `index.php?delete=${id}`;
      }
    }
  </script>
</head>

<body>
  <div class="container">
    <h1>CRUD Application</h1>

    <?php if ($success): ?>
      <p class="success"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <?php if ($errors): ?>
      <ul class="errors">
        <?php foreach ($errors as $error): ?>
          <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <!-- Create/Edit Form -->
    <form method="POST" action="index.php">
      <input type="hidden" name="id" value="<?php echo $editId; ?>">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $editRecord ? htmlspecialchars($editRecord['name']) : ''; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $editRecord ? htmlspecialchars($editRecord['email']) : ''; ?>" required>
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $editRecord ? $editRecord['age'] : ''; ?>" min="1" required>
      </div>
      <button type="submit"><?php echo $editId ? 'Update' : 'Create'; ?> Record</button>
    </form>

    <!-- Search Form -->
    <form method="GET" action="index.php" class="search-form">
      <input type="text" name="search" placeholder="Search by name or email" value="<?php echo htmlspecialchars($searchQuery); ?>">
      <button type="submit">Search</button>
    </form>

    <!-- Data Table -->
    <h2>Records</h2>
    <?php if ($records): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($records as $record): ?>
            <tr>
              <td><?php echo $record['id']; ?></td>
              <td><?php echo htmlspecialchars($record['name']); ?></td>
              <td><?php echo htmlspecialchars($record['email']); ?></td>
              <td><?php echo $record['age']; ?></td>
              <td>
                <a href="index.php?edit=<?php echo $record['id']; ?>">Edit</a>
                <a href="#" onclick="confirmDelete(<?php echo $record['id']; ?>)">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No records found.</p>
    <?php endif; ?>
  </div>
</body>

</html>