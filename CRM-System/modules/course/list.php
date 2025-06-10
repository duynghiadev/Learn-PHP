<?php
require_once 'config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

if (!defined('_CODE')) {
    die('Access denied...');
}

// Set page title
$data = [
    'pageTitle' => 'Danh sách khóa học'
];

// Fetch all courses from the database
$courses = getRaw('SELECT * FROM course');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản lý người dùng'; ?></title>
    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATES; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _HOST_URL_TEMPLATES; ?>/css/style.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4"><?php echo $data['pageTitle']; ?></h2>
        <?php if (!empty($courses)): ?>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên khóa học</th>
                        <th>Slug</th>
                        <th>Danh mục ID</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Thumbnail</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo $course['id']; ?></td>
                            <td><?php echo $course['name']; ?></td>
                            <td><?php echo $course['slug']; ?></td>
                            <td><?php echo $course['category_id']; ?></td>
                            <td><?php echo $course['description']; ?></td>
                            <td><?php echo number_format($course['price'], 0, ',', '.') . ' VND'; ?></td>
                            <td>
                                <img src="<?php echo $course['thumnail']; ?>" alt="<?php echo $course['name']; ?>" width="100">
                            </td>
                            <td><?php echo $course['created_at']; ?></td>
                            <td><?php echo $course['updated_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Không có khóa học nào trong cơ sở dữ liệu.
            </div>
        <?php endif; ?>
        <a href="?module=dashboard&action=index" class="btn btn-primary mt-3">Quay lại trang chủ</a>
    </div>
</body>

</html>