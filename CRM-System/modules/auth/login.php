<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Đăng nhập tài khoản'
];

layouts('header-login', $data);

// Kiểm tra trạng thái đăng nhập
if (isLogin()) {
    redirect('?module=home&action=dashboard');
    exit;
}

if (isPost()) {
    $filterAll = filter();

    if (!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))) {
        $email = filter_var($filterAll['email'], FILTER_SANITIZE_EMAIL);
        $password = $filterAll['password'];

        // Truy vấn an toàn để tránh SQL injection
        $query = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $userQuery = $result->fetch_assoc();

        if ($userQuery) {
            $passwordHash = $userQuery['password'];
            $userId = $userQuery['id'];

            if (password_verify($password, $passwordHash)) {
                // Kiểm tra trạng thái đăng nhập
                $query = "SELECT * FROM loginToken WHERE user_Id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $userId);
                $stmt->execute();
                $userLogin = $stmt->get_result()->num_rows;

                if ($userLogin > 0) {
                    setFlashData('msg', 'Tài khoản đang đăng nhập ở nơi khác.');
                    setFlashData('msg_type', 'danger');
                    redirect('?module=auth&action=login');
                    exit;
                }

                // Tạo token đăng nhập
                $tokenLogin = sha1(uniqid() . time());
                $dataInsert = [
                    'user_Id' => $userId,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];

                if (insert('loginToken', $dataInsert)) {
                    setSession('loginToken', $tokenLogin);
                    setFlashData('msg', 'Đăng nhập thành công!');
                    setFlashData('msg_type', 'success');
                    redirect('?module=home&action=dashboard');
                    exit;
                } else {
                    setFlashData('msg', 'Không thể đăng nhập, vui lòng thử lại sau.');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Mật khẩu không chính xác.');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Email không tồn tại.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng nhập email và mật khẩu.');
        setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=login');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng nhập quản lý Users</h2>
        <?php if (!empty($msg)) {
            getSmg($msg, $msg_type);
        } ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" required>
            </div>
            <div class="form-group mg-form">
                <label for="password">Mật khẩu</label>
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng Nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>