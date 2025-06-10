<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
  die('Access denied...');
}

if (!isLogin()) {
  setFlashData('msg', 'Vui lòng đăng nhập để tiếp tục!');
  setFlashData('msg_type', 'danger');
  redirect('?module=auth&action=login');
  exit;
}
