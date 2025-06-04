

<?php 
/*  
try{

}
catch(){

}
-> xử lý ngoại lệ khi chương trình gặp lỗi vẫn chạy bình thường.

*/
$age = 18;
try {
    //  gõ code 
    echo 'Hienu- Vũ trụ marketing '.'<br>';
    //hienu();
    // if($age < 20){
    //     throw new Exception('Tuổi phải lớn hơn 20');
    // }

}catch (Error $exception) {
    echo $exception -> getMessage().'<br>';
    echo 'File: '. $exception -> getFile().'<br>';
    echo 'Line: '. $exception -> getLine();
}
// catch (Exception $exception) {
//     echo $exception -> getMessage().'<br>';
//     echo 'File: '. $exception -> getFile().'<br>';
//     echo 'Line: '. $exception -> getLine();
// }

echo '<br>';
echo 'Chương trình vẫn chạy bình thường';