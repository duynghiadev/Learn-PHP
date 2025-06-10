<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Quên mật khẩu'
];

layouts('header-login', $data);

if (isLogin()) {
    redirect('?module=home&action=dashboard');
    exit;
}

if (isPost()) {
    $filterAll = filter();
    if (!empty(trim($filterAll['email']))) {
        $email = filter_var($filterAll['email'], FILTER_SANITIZE_EMAIL);
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $queryUser = $stmt->get_result()->fetch_assoc();

        if ($queryUser) {
            $userId = $queryUser['id'];
            $forgotToken = sha1(uniqid() . time());
            $dataUpdate = [
                'forgotToken' => $forgotToken,
                'update_at' => date('Y-m-d H:i:s')
            ];

            if (update('users', $dataUpdate, "id = $userId")) {
                $linkReset = _WEB_HOST . '?module=auth&action=reset&token=' . $forgotToken;
                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn,<br>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu. Vui lòng click vào link sau để đặt lại mật khẩu:<br>';
                $content .= $linkReset . '<br>';
                $content .= 'Trân trọng!';

                if (sendMail($email, $subject, $content)) {
                    setFlashData('msg', 'Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu!');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau! (email)');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Địa chỉ email không tồn tại trong hệ thống.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập địa chỉ email.');
        setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=forgot');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Quên mật khẩu</h2>
        <?php if (!empty($msg)) {
            getSmg($msg, $msg_type);
        } ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" required>
            </div>
            <button type="submit" class="mg-btn btn btn-primary btn-block">Gửi</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>