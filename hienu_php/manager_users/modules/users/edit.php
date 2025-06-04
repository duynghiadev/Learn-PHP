<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();

if(!empty($filterAll['id'])){
    $userId = $filterAll['id'];

    // Kiểm tra xem userId nó tồn tại trong database không?
    // Nếu tồn tại => Lấy ra thông tin người dùng
    // Nếu không tồn tại => Chuyển hướng về trang list

    $userDetail = oneRaw("SELECT * FROM users WHERE id='$userId'");
    if(!empty($userDetail)){
        // Tồn tại 
        setFlashData('user-detail',$userDetail);
    }else {
        redirect('?module=users&action=list');
    }


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
        $sql = "SELECT id FROM users WHERE email = '$email' AND id <> $userId ";
        if(getRows($sql) > 0){
            $errors['email']['unique'] = 'Email đã tồn tại.';
        }
    }

    // Validate số điện thoại: bắt buộc phải nhập, số có đúng định dạng không
    if (empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập.';
    } else {
        if(!isPhone($filterAll['phone'])){
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ.';
        }
    }

 if(!empty($filterAll['password'])){
       // Validate pasword_confirm: bắt buộc phải nhập, giống password
       if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Bạn phải nhập lại mật khẩu.';
    } else {
        if(($filterAll['password']) != $filterAll['password_confirm']){
            $errors['password_confirm']['match'] = 'Mật khẩu bạn nhập lại không đúng.';
        }
    }
 }


   if(empty($errors)){

    $dataUpdate = [
        'fullname' => $filterAll['fullname'],
        'email' => $filterAll['email'],
        'phone' => $filterAll['phone'],
        'status' => $filterAll['status'],
        'create_at' => date('Y-m-d H:i:s')
    ];

    if(!empty($filterAll['password'])){
        $dataUpdate['password'] = password_hash($filterAll['password'],PASSWORD_DEFAULT);
    }

    $condition = "id = $userId";
    $UpdateStatus = update('users',$dataUpdate,$condition);
    if($UpdateStatus){
        setFlashData('smg','Sửa người dùng thành công!!');
        setFlashData('smg_type','success');

    }else {
        setFlashData('smg','Hệ thống đang lỗi vui lòng thử lại sau.');
        setFlashData('smg_type','danger');
    }
    
   }else {
        setFlashData('smg','Vui lòng kiểm tra lại dữ liệu!!');
        setFlashData('smg_type','danger');
        setFlashData('errors',$errors);
        setFlashData('old',$filterAll);
   }

   redirect('?module=users&action=edit&id='.$userId);
}

layouts('header-login', $data);


$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetailll = getFlashData('user-detail');
if(!empty($userDetailll)){
    $old = $userDetailll;
}


?>

<div class="container">
    <div class="row" style="margin: 50px auto;">

        <h2 class="text-center text-uppercase">Update người dùng </h2>
        <?php 
            if(!empty($smg)){
               getSmg($smg,$smg_type);
            }
           
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Họ tên</label>
                        <input name="fullname" type="fullname" class="form-control" placeholder="Họ tên" value="<?php 
                echo old('fullname',$old);
                ?>">
                        <?php 
                    echo form_error('fullname','<span class="error">','</span>',$errors );
                ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?php 
                 echo old('email',$old);
                ?>">
                        <?php 
                     echo form_error('email','<span class="error">','</span>',$errors );
                ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Số điện thoại</label>
                        <input name="phone" type="number" class="form-control" placeholder="Địa chỉ email" value="<?php 
                 echo old('phone',$old);
                ?>">
                        <?php 
                    echo form_error('phone','<span class="error">','</span>',$errors );
                ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Pasword</label>
                        <input name="password" type="text" class="form-control" placeholder="Mật khẩu (Không nhập nếu không thay đổi)">
                        <?php 
                     echo form_error('password','<span class="error">','</span>',$errors );
                ?>
                    </div>
                    <div class="form-group  mg-form">
                        <label for="">Nhập lại Pasword</label>
                        <input name="password_confirm" type="password" class="form-control"
                            placeholder="Nhập lại mật khẩu (Không nhập nếu không thay đổi)">
                        <?php 
                     echo form_error('password_confirm','<span class="error">','</span>',$errors );
                ?>
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" id="" class="form-control">
                            <option value="0" <?php echo (old('status',$old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                            <option value="1" <?php echo (old('status',$old) == 1) ? 'selected' : false; ?>>Đã kích hoạt</option>
                        </select>

                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $userId ?>">

            <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Update người dùng</button>
            <a href="?module=users&action=list"  class="btn-user  mg-btn btn btn-success btn-block">Quay lại</a>

            <hr>

            
        </form>
    </div>
</div>


<?php
layouts('footer-login');
?>