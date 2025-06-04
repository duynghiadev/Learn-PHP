<!-- 
    Validate form Client : Thẻ HTML 5 , JS
    Validate form Server : PHP

    Bắt lỗi : 
    Họ tên -> Bắt buộc và lớn hơn 5 ký tự
    Email: -> Bắt buôc và phải đúng định dạng email

 -->
<?php 
    if(!empty($_POST)){

        $errors = [];

        // Bắt lỗi của fullname
        if(empty($_POST['fullname'])){
            $errors['fullname']['required'] = 'Bắt buộc phải nhập họ tên';
        }
        else {
            if(strlen($_POST['fullname']) < 5){
                $errors['fullname']['min_length'] = 'Họ tên phải lớn hơn hoặc bằng 5 ký tự';
            }
        }

        // Bắt lỗi với email
        if(empty($_POST['email'])){
            $errors['email']['required'] = 'Bắt buộc phải điền email';
        
        }
        else {
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $errors['email']['invaild'] = 'Email không đúng định dạng';
            }
        }

        // if(empty($errors)){
        //     echo 'Validate thành công, không có lỗi';
        // }
        // else {
        //     echo 'Có lỗi xảy ra';
        // }

        echo '<pre>';
        print_r($errors);
        echo '</pre>';


    }

?>

<form method="post" action="">
    <p>Họ tên :
        <input type="text" name="fullname" placeholder="Họ tên" >
        <?php  echo  !empty($errors['fullname']['required']) ? '<p style="color:red;">'.$errors['fullname']['required'] .'</p>' : '';  ?>
        <?php  echo  !empty($errors['fullname']['min_length']) ? '<p style="color:red;">'.$errors['fullname']['min_length']. '</p>' : '';  ?>

    </p>
    <p>Email:
        <input type="text" name="email" placeholder="Email" >
        <?php  echo  !empty($errors['email']['required']) ? '<p style="color:red;">'.$errors['email']['required'] .'</p>' : '';  ?>
        <?php  echo  !empty($errors['email']['invaild']) ? '<p style="color:red;">'.$errors['email']['invaild']. '</p>' : '';  ?>

    </p>

    <button type="submit">Xác nhận</button>
</form>

