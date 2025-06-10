<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

if (!defined('_CODE')) {
  die('Access denied...');
}

// Set page title
$data = [
  'pageTitle' => 'Xóa Khóa Học'
];

// Get course ID from URL
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$course = oneRaw("SELECT * FROM course WHERE id = $course_id");

if (empty($course)) {
  header('Location: ?module=course&action=list');
  exit;
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (delete('course', "id = $course_id")) {
    echo '<div class="alert alert-success text-center">Xóa khóa học thành công!</div>';
    header('Location: ?module=course&action=list');
    exit;
  } else {
    echo '<div class="alert alert-danger text-center">Xóa khóa học thất bại!</div>';
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
    <div class="alert alert-warning text-center">
      Bạn có chắc chắn muốn xóa khóa học "<strong><?php echo $course['name']; ?></strong>" không?
    </div>
    <form action="?module=course&action=delete&id=<?php echo $course_id; ?>" method="POST" class="w-75 mx-auto">
      <button type="submit" class="btn btn-danger w-100">Xác nhận xóa</button>
      <a href="?module=course&action=list" class="btn btn-secondary w-100 mt-2">Hủy</a>
    </form>
  </div>
</body>

</html>