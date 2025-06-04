<?php 
require_once "connect.php";

$sql = "UPDATE hocsinh SET fullname = :fullname, age = :age WHERE id = :id";

// Data 
$fullname = 'Nghĩa';
$age = 35;
$id = 8;

try {

    $statement = $conn -> prepare($sql);

    // $statement -> bindParam(':fullname', $fullname);
    // $statement -> bindParam(':age', $age);
    // $statement -> bindParam(':id', $id);

    $data = [
        'fullname' => $fullname,
        'age' => $age,
        'id' => $id
    ];

    $updateStatus = $statement -> execute($data);
    if($updateStatus){
        echo 'Update thành công';
    }

}catch(Exception $exp){
    echo $exp -> getMessage().'<br>';
    echo 'File: '. $exp -> getFile().'<br>';
    echo 'Line: '. $exp -> getLine();
}
