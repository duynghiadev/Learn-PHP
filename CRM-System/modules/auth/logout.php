<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

if (isLogin()) {
    $token = getSession('loginToken');
    $query = "DELETE FROM loginToken WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    removeSession('loginToken');
    setFlashData('msg', 'Đăng xuất thành công!');
    setFlashData('msg_type', 'success');
}
redirect('?module=auth&action=login');
