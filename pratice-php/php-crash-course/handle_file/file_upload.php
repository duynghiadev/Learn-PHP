<?php
if (isset($_POST['submit'])) {
    $permitted_extensions = ['png', 'jpg', 'jpeg', 'gif'];
    $allowed_mimes = ['image/png', 'image/jpeg', 'image/gif'];

    $file_name = $_FILES['upload']['name'];

    if (!empty($file_name)) {
        $file_size = $_FILES['upload']['size'];
        $file_tmp_name = $_FILES['upload']['tmp_name'];

        // Làm sạch tên file
        $clean_file_name = preg_replace("/[^a-zA-Z0-9\.-]/", "_", $file_name);

        // Tạo tên file mới
        $generated_file_name = time() . '-' . $clean_file_name;
        $destination_path = "uploads/{$generated_file_name}";

        // Lấy phần mở rộng file
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Lấy MIME type thật sự của file
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp_name);
        finfo_close($finfo);

        // Kiểm tra định dạng và MIME
        if (in_array($file_extension, $permitted_extensions) && in_array($mime, $allowed_mimes)) {
            if ($file_size <= 1000000) {
                // Tạo thư mục nếu chưa có
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0755, true);
                }

                // Di chuyển file
                if (move_uploaded_file($file_tmp_name, $destination_path)) {
                    $message = '<p style="color:green;">File is uploaded</p>';
                } else {
                    $message = '<p style="color:red;">Upload failed</p>';
                }
            } else {
                $message = '<p style="color:red;">File is too big (max 1MB)</p>';
            }
        } else {
            $message = '<p style="color:red;">Invalid file type</p>';
        }
    } else {
        $message = '<p style="color:red;">No file selected, please try again</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>File Upload</title>
</head>

<body>
  <h1>File upload in PHP</h1>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
    enctype="multipart/form-data">
    Choose your image to upload:
    <input type="file" name="upload" accept="image/*" required>
    <input type="submit" value="submit" name="submit">
  </form>
  <?php echo $message ?? ''; ?>

  <?php if (isset($destination_path) && file_exists($destination_path)): ?>
  <p>Preview:</p>
  <img src="<?php echo htmlspecialchars($destination_path); ?>" style="max-width: 300px;">
  <?php endif; ?>
</body>

</html>