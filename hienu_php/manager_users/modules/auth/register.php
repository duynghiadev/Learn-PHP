<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

if (isPost()) {
    $filterAll = filter();

    $errors = []; // Mảng chữa các lỗi

    // Validate fullname: bắt buộc phải nhập, min 5 ký tự
    if (empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập.';
    } else {
        if (strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min'] = 'Họ tên phải có ít nhất 5 ký tự.';
        }
    }


    // Email Validate: bắt buộc phải nhập, đúng đinh dạng email, kiểm tra email đã tồn tại trong csdl chưa

    if (empty($filterAll['email'])) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập.';
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT id FROM users WHERE email = '$email'";
        if (getRows($sql) > 0) {
            $errors['email']['unique'] = 'Email đã tồn tại.';
        }
    }

    // Validate số điện thoại: bắt buộc phải nhập, số có đúng định dạng không
    if (empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập.';
    } else {
        if (!isPhone($filterAll['phone'])) {
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ.';
        }
    }

    // Validate password: bắt buộc phải nhập, >=8 ký tự
    if (empty($filterAll['password'])) {
        $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập.';
    } else {
        if (strlen($filterAll['password']) < 8) {
            $errors['password']['min'] = 'Mật khẩu phải lớn hơn hoặc bằng 8.';
        }
    }

    // Validate pasword_confirm: bắt buộc phải nhập, giống password
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Bạn phải nhập lại mật khẩu.';
    } else {
        if (($filterAll['password']) != $filterAll['password_confirm']) {
            $errors['password_confirm']['match'] = 'Mật khẩu bạn nhập lại không đúng.';
        }
    }


    if (empty($errors)) {

        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s')
        ];


        $insertStatus = insert('users', $dataInsert);
        if ($insertStatus) {

            // Tạo link kích hoạt
            $linkActive = _WEB_HOST . '?module=auth&action=active&token=' . $activeToken;

            // Thiết lập gửi mail
            $subject = $filterAll['fullname'] . 'vui lòng kích hoạt tài khoản!!';
            $content = 'Chào ' . $filterAll['fullname'] . '.</br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản: </br>';
            $content .=  $linkActive . '</br>';
            $content .= 'Trân trọng cảm ơn!!';

            // Tiến hành gửi mail
            $senMail = sendMail($filterAll['email'], $subject, $content);

            if ($senMail) {
                setFlashData('smg', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản!!');
                setFlashData('smg_type', 'success');
            } else {
                setFlashData('smg', 'Hệ thống đang gặp sự cố, vui lòng thử lại sau!!');
                setFlashData('smg_type', 'danger');
            }
        } else {
            setFlashData('smg', 'Đăng ký không thành công!!');
            setFlashData('smg_type', 'danger');
        }
        redirect('?module=auth&action=register');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=auth&action=register');
    }
}

layouts('header-login', $data);


$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');



?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng ký tài khoản Users </h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }

        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Họ tên</label>
                <input name="fullname" type="fullname" class="form-control" placeholder="Họ tên" value="<?php
                                                                                                        echo old('fullname', $old);
                                                                                                        ?>">
                <?php
                echo form_error('fullname', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?php
                                                                                                            echo old('email', $old);
                                                                                                            ?>">
                <?php
                echo form_error('email', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Số điện thoại</label>
                <input name="phone" type="number" class="form-control" placeholder="Địa chỉ email" value="<?php
                                                                                                            echo old('phone', $old);
                                                                                                            ?>">
                <?php
                echo form_error('phone', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Pasword</label>
                <input name="password" type="text" class="form-control" placeholder="Mật khẩu">
                <?php
                echo form_error('password', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group  mg-form">
                <label for="">Nhập lại Pasword</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                <?php
                echo form_error('password_confirm', '<span class="error">', '</span>', $errors);
                ?>
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