<?php
echo "File Handling in PHP<br>";

$file_path = './fruits.txt';

if (file_exists($file_path)) {
    $file_handle = fopen($file_path, 'r');
    $file_content = fread($file_handle, filesize($file_path));
    fclose($file_handle);
    echo "<strong>Nội dung file:</strong><br>";
    echo nl2br($file_content); // In đẹp hơn
} else {
    $file_handle = fopen($file_path, 'w');
    $file_content = 'banana' . PHP_EOL . 'mango' . PHP_EOL . 'grape';
    fwrite($file_handle, $file_content);
    fclose($file_handle);
    echo "File không tồn tại. Đã tạo file mới.<br>";
}