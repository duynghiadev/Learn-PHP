<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

if (!defined('_CODE')) {
  die('Access denied...');
}

// Bắt đầu session để lưu thông báo
session_start();

// Set page title
$data = [
  'pageTitle' => 'Thêm Khóa Học'
];

// Fetch categories for dropdown
$categories = getRaw('SELECT * FROM course_category');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $courseData = [
    'name' => isset($_POST['name']) ? $_POST['name'] : '',
    'slug' => isset($_POST['slug']) ? $_POST['slug'] : '',
    'category_id' => isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0,
    'description' => isset($_POST['description']) ? $_POST['description'] : '',
    'price' => isset($_POST['price']) ? (int)$_POST['price'] : 0,
    'thumnail' => isset($_POST['thumnail']) ? $_POST['thumnail'] : '',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
  ];

  if (insert('course', $courseData)) {
    // Lưu thông báo thành công vào session
    $_SESSION['message'] = [
      'type' => 'success',
      'text' => 'Thêm khóa học thành công!'
    ];
    header('Location: ?module=course&action=list');
    exit;
  } else {
    // Lưu thông báo lỗi vào session
    $_SESSION['message'] = [
      'type' => 'danger',
      'text' => 'Thêm khóa học thất bại!'
    ];
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
    <?php
    // Hiển thị thông báo nếu có, trước khi chuyển hướng
    if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-' . $_SESSION['message']['type'] . ' text-center">' . $_SESSION['message']['text'] . '</div>';
      // Xóa thông báo sau khi hiển thị
      unset($_SESSION['message']);
    }
    ?>
    <form action="?module=course&action=create" method="POST" class="w-75 mx-auto">
      <div class="mb-3">
        <label for="name" class="form-label">Tên khóa học</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" required>
      </div>
      <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="">Chọn danh mục</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Giá (VND)</label>
        <input type="number" class="form-control" id="price" name="price" required>
      </div>
      <div class="mb-3">
        <label for="thumnail" class="form-label">Thumbnail URL</label>
        <input type="text" class="form-control" id="thumnail" name="thumnail">
      </div>
      <button type="submit" class="btn btn-primary w-100">Thêm khóa học</button>
      <a href="?module=course&action=list" class="btn btn-secondary w-100 mt-2">Quay lại danh sách</a>
    </form>
  </div>
</body>

</html>