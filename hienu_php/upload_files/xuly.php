<?php 
if(!empty($_SERVER['REQUEST_METHOD'])){
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

}

$result = move_uploaded_file($_FILES['hienu_upload']['tmp_name'], 
'/Applications/XAMPP/xamppfiles/htdocs/hienu_php/upload_files/uploads/'.
 $_FILES['hienu_upload']['name']);
var_dump($result);


?>