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
    $query = "SELECT id, fullname, email FROM users WHERE forgotToken = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $tokenQuery = $stmt->get_result()->fetch_assoc();

    if ($tokenQuery) {
        $userId = $tokenQuery['id'];
        if (isPost()) {
            $filterAll = filter();
            $errors = [];

            // Validate password
            if (empty(trim($filterAll['password']))) {
                $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập.';
            } elseif (strlen(trim($filterAll['password'])) < 8) {
                $errors['password']['min'] = 'Mật khẩu phải lớn hơn hoặc bằng 8 ký tự.';
            }

            // Validate password_confirm
            if (empty(trim($filterAll['password_confirm']))) {
                $errors['password_confirm']['required'] = 'Bạn phải nhập lại mật khẩu.';
            } elseif ($filterAll['password'] !== $filterAll['password_confirm']) {
                $errors['password_confirm']['match'] = 'Mật khẩu nhập lại không đúng.';
            }

            if (empty($errors)) {
                $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forgotToken' => null,
                    'update_at' => date('Y-m-d H:i:s')
                ];

                if (update('users', $dataUpdate, "id = $userId")) {
                    setFlashData('msg', 'Thay đổi mật khẩu thành công!');
                    setFlashData('msg_type', 'success');
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
                    setFlashData('msg_type', 'danger');
                    redirect('?module=auth&action=reset&token=' . $token);
                }
            } else {
                setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token=' . $token);
            }
        }

        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
?>
        <div class="row">
            <div class="col-4" style="margin: 50px auto;">
                <h2 class="text-center text-uppercase">Đặt lại mật khẩu</h2>
                <?php if (!empty($msg)) {
                    getSmg($msg, $msg_type);
                } ?>
                <form action="" method="post">
                    <div class="form-group mg-form">
                        <label for="password">Mật khẩu mới</label>
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu mới">
                        <?php echo form_error('password', '<span class="error">', '</span>', $errors); ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="password_confirm">Nhập lại mật khẩu</label>
                        <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                        <?php echo form_error('password_confirm', '<span class="error">', '</span>', $errors); ?>
                    </div>
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <button type="submit" class="mg-btn btn btn-primary btn-block">Gửi</button>
                    <hr>
                    <p class="text-center"><a href="?module=auth&action=login">Đăng nhập tài khoản</a></p>
                </form>
            </div>
        </div>
<?php
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
?>