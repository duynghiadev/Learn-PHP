<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

layouts('header-login');

$token = filter()['token'];

if (!empty($token)) {
    $query = "SELECT id FROM users WHERE activeToken = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $tokenQuery = $stmt->get_result()->fetch_assoc();

    if ($tokenQuery) {
        $userId = $tokenQuery['id'];
        $dataUpdate = [
            'status' => 1,
            'activeToken' => null,
            'update_at' => date('Y-m-d H:i:s')
        ];

        if (update('users', $dataUpdate, "id = $userId")) {
            setFlashData('msg', 'Kích hoạt tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Kích hoạt tài khoản không thành công, vui lòng liên hệ quản trị viên!');
            setFlashData('msg_type', 'danger');
        }
        redirect('?module=auth&action=login');
    } else {
        setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn!');
        setFlashData('msg_type', 'danger');
        redirect('?module=auth&action=login');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn!');
    setFlashData('msg_type', 'danger');
    redirect('?module=auth&action=login');
}

layouts('footer-login');
