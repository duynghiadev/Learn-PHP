<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

if (!defined('_CODE')) {
  die('Access denied...');
}

// Set page title
$data = [
  'pageTitle' => 'Chỉnh Sửa Khóa Học'
];

// Get course ID from URL
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$course = oneRaw("SELECT * FROM course WHERE id = $course_id");

if (empty($course)) {
  header('Location: ?module=course&action=list');
  exit;
}

// Fetch categories for dropdown
$categories = getRaw('SELECT * FROM course_category');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $courseData = [
    'name' => isset($_POST['name']) ? $_POST['name'] : $course['name'],
    'slug' => isset($_POST['slug']) ? $_POST['slug'] : $course['slug'],
    'category_id' => isset($_POST['category_id']) ? (int)$_POST['category_id'] : $course['category_id'],
    'description' => isset($_POST['description']) ? $_POST['description'] : $course['description'],
    'price' => isset($_POST['price']) ? (int)$_POST['price'] : $course['price'],
    'thumnail' => isset($_POST['thumnail']) ? $_POST['thumnail'] : $course['thumnail'],
    'updated_at' => date('Y-m-d H:i:s')
  ];

  if (update('course', $courseData, "id = $course_id")) {
    echo '<div class="alert alert-success text-center">Cập nhật khóa học thành công!</div>';
    header('Location: ?module=course&action=list');
    exit;
  } else {
    echo '<div class="alert alert-danger text-center">Cập nhật khóa học thất bại!</div>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản lý người dùng'; ?></title>
  <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATES; ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATES; ?>/css/style.css?ver=<?php echo rand(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $data['pageTitle']; ?></h2>
    <form action="?module=course&action=edit&id=<?php echo $course_id; ?>" method="POST" class="w-75 mx-auto">
      <div class="mb-3">
        <label for="name" class="form-label">Tên khóa học</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $course['name']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $course['slug']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="">Chọn danh mục</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $course['category_id'] ? 'selected' : ''; ?>>
              <?php echo $category['name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $course['description']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Giá (VND)</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo $course['price']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="thumnail" class="form-label">Thumbnail URL</label>
        <input type="text" class="form-control" id="thumnail" name="thumnail" value="<?php echo $course['thumnail']; ?>">
      </div>
      <button type="submit" class="btn btn-primary w-100">Cập nhật khóa học</button>
      <a href="?module=course&action=list" class="btn btn-secondary w-100 mt-2">Quay lại danh sách</a>
    </form>
  </div>
</body>

</html>