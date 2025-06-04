<?php
/* 

$stmt = $con->prepare('INSERT INTO users (username, password, create_at,
status) values (:username, :password, :create_at, :status)');
$username = 'hoangan.web';
$password = '123456';
$now = date('Y-m-d H:i:s');
$status = 1;
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':create_at', $now);
$stmt->bindParam(':status', $status);
$stmt->execute(); //Chạy câu lệnh SQL

*/

require_once "connect.php";

$sql = "INSERT INTO hocsinh(fullname, age) VALUES(:fullname,:age)";

try{
    $statement = $conn -> prepare($sql);

    $fullname = 'Minh';
    $age = '40';
    
    // $statement -> bindParam(':fullname',$fullname);
    // $statement -> bindParam(':age', $age);

    $data =[
        'fullname' => $fullname,
        'age' => $age
    ];
    
    $insertStatus = $statement -> execute($data);
    
    var_dump($insertStatus);
}catch(Exception $exp){
    echo $exp -> getMessage().'<br>';
    echo 'File: '. $exp -> getFile().'<br>';
    echo 'Line: '. $exp -> getLine();
}




