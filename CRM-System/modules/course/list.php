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
    <style>
        .action-btn {
            margin: 0 5px;
            padding: 6px 12px;
            font-size: 14px;
        }

        .btn-add {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-add:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            margin-bottom: 10px;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center mb-0"><?php echo $data['pageTitle']; ?></h2>
            <a href="?module=course&action=create" class="btn btn-add text-white">
                <i class="fas fa-plus"></i> Thêm khóa học
            </a>
        </div>
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
                        <th>Hành động</th>
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
                            <td>
                                <a href="?module=course&action=edit&id=<?php echo $course['id']; ?>" class="btn btn-edit action-btn">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="?module=course&action=delete&id=<?php echo $course['id']; ?>" class="btn btn-delete action-btn text-white"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học <?php echo $course['name']; ?> không?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Không có khóa học nào trong cơ sở dữ liệu.
            </div>
        <?php endif; ?>
        <a href="?module=dashboard" class="btn btn-primary mt-3">Quay lại trang chủ</a>
    </div>
</body>

</html>