<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';
require_once './includes/session.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

define('_WEB_HOST', 'http://localhost/Learn-PHP/CRM-System');

if (isPost()) {
    $filterAll = filter();
    $errors = [];

    // Validate fullname
    if (empty(trim($filterAll['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập.';
    } elseif (strlen(trim($filterAll['fullname'])) < 5) {
        $errors['fullname']['min'] = 'Họ tên phải có ít nhất 5 ký tự.';
    }

    // Validate email
    if (empty(trim($filterAll['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập.';
    } else {
        $email = filter_var($filterAll['email'], FILTER_SANITIZE_EMAIL);
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors['email']['unique'] = 'Email đã tồn tại.';
        }
    }

    // Validate phone
    if (empty(trim($filterAll['phone']))) {
        $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập.';
    } elseif (!isPhone($filterAll['phone'])) {
        $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ.';
    }

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
        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'fullname' => trim($filterAll['fullname']),
            'email' => $email,
            'phone' => trim($filterAll['phone']),
            'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s')
        ];

        if (insert('users', $dataInsert)) {
            $linkActive = _WEB_HOST . '?module=auth&action=active&token=' . $activeToken;
            $subject = 'Kích hoạt tài khoản của ' . $filterAll['fullname'];
            $content = 'Chào ' . $filterAll['fullname'] . ',<br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản:<br>';
            $content .= $linkActive . '<br>';
            $content .= 'Trân trọng cảm ơn!';

            if (sendMail($email, $subject, $content)) {
                setFlashData('msg', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
                setFlashData('msg_type', 'success');
                redirect('?module=auth&action=login');
            } else {
                setFlashData('msg', 'Hệ thống gặp sự cố, vui lòng thử lại sau!');
                setFlashData('msg_type', 'danger');
                redirect('?module=auth&action=register');
            }
        } else {
            setFlashData('msg', 'Đăng ký không thành công!');
            setFlashData('msg_type', 'danger');
            redirect('?module=auth&action=register');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=auth&action=register');
    }
}

layouts('header-login', $data);

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng ký tài khoản Users</h2>
        <?php if (!empty($msg)) {
            getSmg($msg, $msg_type);
        } ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="fullname">Họ tên</label>
                <input name="fullname" type="text" class="form-control" placeholder="Họ tên" value="<?php echo old('fullname', $old); ?>">
                <?php echo form_error('fullname', '<span class="error">', '</span>', $errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?php echo old('email', $old); ?>">
                <?php echo form_error('email', '<span class="error">', '</span>', $errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="phone">Số điện thoại</label>
                <input name="phone" type="text" class="form-control" placeholder="Số điện thoại" value="<?php echo old('phone', $old); ?>">
                <?php echo form_error('phone', '<span class="error">', '</span>', $errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="password">Mật khẩu</label>
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                <?php echo form_error('password', '<span class="error">', '</span>', $errors); ?>
            </div>
            <div class="form-group mg-form">
                <label for="password_confirm">Nhập lại mật khẩu</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                <?php echo form_error('password_confirm', '<span class="error">', '</span>', $errors); ?>
            </div>
            <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng Ký</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập tài khoản</a></p>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>