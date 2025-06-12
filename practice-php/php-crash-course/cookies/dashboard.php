<?php
session_start();

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit;
}

// Check session timeout (30 minutes)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_unset();
  session_destroy();
  header('Location: login.php?timeout=1');
  exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

// Check user agent and IP for session hijacking
if (
  $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] ||
  $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']
) {
  session_unset();
  session_destroy();
  header('Location: login.php?hijack=1');
  exit;
}

// Xử lý đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  // Xóa tất cả biến session
  $_SESSION = array();

  // Xóa cookie session
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }

  // Hủy session
  session_destroy();

  // Xóa cookie remember me
  setcookie('remember_token', '', time() - 3600, '/', '', true, true);

  // Chuyển hướng và dừng script
  header("Location: login.php?logout=1");
  exit;
}

// Kiểm tra nếu đã đăng xuất thì không cho truy cập
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng điều khiển</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="dashboard.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header text-center">
      <h4>Hệ thống quản trị</h4>
    </div>
    <ul class="sidebar-menu">
      <li><a href="dashboard.php" class="active"><i class="bi bi-speedometer2"></i> Bảng điều
          khiển</a></li>
      <li><a href="#"><i class="bi bi-people"></i> Quản lý người dùng</a></li>
      <li><a href="#"><i class="bi bi-file-earmark-text"></i> Quản lý bài viết</a></li>
      <li><a href="#"><i class="bi bi-gear"></i> Cài đặt hệ thống</a></li>
      <li><a href="?action=logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2><i class="bi bi-speedometer2"></i> Bảng điều khiển</h2>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
          <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Hồ sơ</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Cài đặt</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="?action=logout"><i class="bi bi-box-arrow-right"></i>
              Đăng xuất</a></li>
        </ul>
      </div>
    </div>

    <!-- Welcome Card -->
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-house-door"></i> Chào mừng</h5>
      </div>
      <div class="card-body text-center">
        <img
          src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user_name']) ?>&background=3498db&color=fff"
          alt="User Profile" class="user-profile-img mb-3">
        <h4>Xin chào, <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?></h4>
        <p class="text-muted">Bạn đã đăng nhập với email:
          <?= htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?></p>
        <p class="text-muted">Thời gian đăng nhập:
          <?= date('H:i:s d/m/Y', $_SESSION['LAST_ACTIVITY']) ?></p>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Người dùng</h6>
                <h2 class="mb-0">128</h2>
              </div>
              <i class="bi bi-people" style="font-size: 2rem;"></i>
            </div>
            <div class="mt-3">
              <a href="#" class="text-white">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-success text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Bài viết</h6>
                <h2 class="mb-0">356</h2>
              </div>
              <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
            </div>
            <div class="mt-3">
              <a href="#" class="text-white">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-info text-white">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Bình luận</h6>
                <h2 class="mb-0">1,024</h2>
              </div>
              <i class="bi bi-chat-left-text" style="font-size: 2rem;"></i>
            </div>
            <div class="mt-3">
              <a href="#" class="text-white">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="card mt-4">
      <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-clock-history"></i> Hoạt động gần đây</h5>
      </div>
      <div class="card-body">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Bài viết mới được tạo</h6>
              <small>5 phút trước</small>
            </div>
            <p class="mb-1">"Hướng dẫn sử dụng hệ thống quản trị"</p>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Người dùng mới đăng ký</h6>
              <small>1 giờ trước</small>
            </div>
            <p class="mb-1">Nguyễn Văn B (user@example.com)</p>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Cập nhật hệ thống</h6>
              <small>3 giờ trước</small>
            </div>
            <p class="mb-1">Phiên bản 2.1.0 đã được cập nhật</p>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
</body>

</html>