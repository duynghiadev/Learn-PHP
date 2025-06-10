<?php
require_once 'config.php';

if (!defined('_CODE')) {
    die('Access denied...');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy</title>
    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATES; ?>/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h1>404 - Trang không tìm thấy</h1>
        <p>Xin lỗi, trang bạn yêu cầu không tồn tại.</p>
        <a href="?module=dashboard&action=index" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</body>

</html>