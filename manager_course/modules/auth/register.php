<?php
if (!defined('_HIENU')) {
  die('Truy cập không hợp lệ');
}

$data = [
  'title' => 'Đăng ký tài khoản'
];
layout('header-auth', $data);


if (isPost()) {
  $filter = filterData();
  $errors = [];

  // validate fullname
  if (empty(trim($filter['fullname']))) {
    $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
  } else {
    if (strlen(trim($filter['fullname'])) < 5) {
      $errors['fullname']['length'] = 'Họ tên phải lớn hơn 5 ký tự';
    }
  }

  // Validate email
  if (empty(trim($filter['email']))) {
    $errors['email']['required'] = 'Email bắt buộc phải nhập';
  } else {
    // Đúng định dạng email, email này đã tồn tại trong database chưa
    if (!validateEmail(trim($filter['email']))) {
      $errors['email']['isEmail'] = 'Email không đúng định dạng';
    } else {
      $email = $filter['email'];

      $checkEmail = getRows("SELECT * FROM users WHERE email = '$email' ");
      if ($checkEmail > 0) {
        $errors['email']['check'] = 'Email đã tồn tại';
      }
    }
  }

  // Validate phone
  if (empty($filter['phone'])) {
    $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập';
  } else {
    if (!isPhone($filter['phone'])) {
      $errors['phone']['isPhone'] = 'Số điện thoại ko đúng định dạng';
    }
  }

  // Validate Password MK > 6 ký tự
  if (empty(trim($filter['password']))) {
    $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
  } else {
    if (strlen(trim($filter['password'])) < 6) {
      $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 ký tự';
    }
  }

  // Validate confirm password
  if (empty(trim($filter['password']))) {
    $errors['confirm_pass']['required'] = 'Vui lòng nhập lại mật khẩu';
  } else {
    if (trim($filter['password']) !== trim($filter['confirm_pass'])) {
      $errors['confirm_pass']['like'] = 'Mật khẩu nhập lại không khớp';
    }
  }

  if (empty($errors)) {
    $msg = 'Đăng ký thành công!';
    $msg_type = 'success';
  } else {

    $msg = 'Dữ liệu không hợp lệ, hãy kiểm tra lại!!';
    $msg_type = 'danger';

    setSessionFlash('errors', $errors);
  }

  $errorsArr  = getSessionFlash('errors');
}

?>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="<?php echo _HOST_URL_TEMPLATES; ?>/assets/image/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <?php getMsg($msg, $msg_type); ?>

        <form method="POST" action="" enctype="multipart/form-data">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <h2 class=" fw-normal mb-5 me-3">Đăng ký tài khoản</h2>
          </div>
          <!--   Name, email, sdt, mật khẩu, nhập lại mk -->

          <div data-mdb-input-init class="form-outline mb-4">
            <input name="fullname" type="text" class="form-control form-control-lg"
              placeholder="Họ tên" />
            <?php
            echo formError($errorsArr, 'fullname');
            ?>
          </div>

          <!-- Nhập email -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="email" type="text" class="form-control form-control-lg"
              placeholder="Địa chỉ email" />
            <?php
            echo formError($errorsArr, 'email');
            ?>
          </div>

          <!-- Nhập số điện thoại -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="phone" type="text" class="form-control form-control-lg"
              placeholder="Nhập số điện thoại" />
            <?php
            echo formError($errorsArr, 'phone');
            ?>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Nhập mật khẩu" />
            <?php
            echo formError($errorsArr, 'password');
            ?>
          </div>

          <!-- Nhập lại mật khẩu -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input name="confirm_pass" type="password" class="form-control form-control-lg"
              placeholder="Nhập lại mật khẩu" />
            <?php
            echo formError($errorsArr, 'confirm_pass');
            ?>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng ký</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn đã có tài khoản? <a href="<?php echo _HOST_URL; ?>?module=auth&action=login"
                class="link-danger">Đăng nhập ngay</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

</section>

<?php
layout('footer');
