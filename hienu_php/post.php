<form method="post" action="">
    <input type="text" name="fullname" placeholder="Họ tên" >
    <input type="text" name="email" placeholder="Email" >
    <button type="submit">Gửi</button>
</form>

<?php 
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    if(isset($_POST['fullname'])){
        echo $_POST['fullname'];
    }
    if(isset($_POST['email'])){
        echo $_POST['email'];
    }
   

?>
