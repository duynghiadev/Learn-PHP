Dựa trên đường dẫn dự án của bạn (http://localhost/Learn-PHP/basic-crud-app/index.php), tôi sẽ cung cấp các liên kết để bạn có thể truy cập và kiểm tra các tính năng của ứng dụng CRUD. Ứng dụng của bạn có các chức năng chính như tạo, chỉnh sửa, xóa và sắp xếp dữ liệu. Dưới đây là các liên kết tương ứng:

### 1. **Trang chính (Danh sách mục và Form tạo/sửa)**

Đây là trang chính của ứng dụng, nơi bạn có thể xem danh sách các mục và sử dụng form để tạo hoặc chỉnh sửa mục.

- **Liên kết** : [http://localhost/Learn-PHP/basic-crud-app/index.php](http://localhost/Learn-PHP/basic-crud-app/index.php)

### 2. **Sắp xếp dữ liệu**

Ứng dụng hỗ trợ sắp xếp dữ liệu theo các cột id, name, và value với thứ tự tăng dần (asc) hoặc giảm dần (desc). Dưới đây là các liên kết để sắp xếp:

- **Sắp xếp theo ID (tăng dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=id&amp;sort_order=asc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=id&sort_order=asc)

- **Sắp xếp theo ID (giảm dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=id&amp;sort_order=desc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=id&sort_order=desc)

- **Sắp xếp theo Name (tăng dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=name&amp;sort_order=asc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=name&sort_order=asc)

- **Sắp xếp theo Name (giảm dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=name&amp;sort_order=desc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=name&sort_order=desc)

- **Sắp xếp theo Value (tăng dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=value&amp;sort_order=asc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=value&sort_order=asc)

- **Sắp xếp theo Value (giảm dần)** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=value&amp;sort_order=desc](http://localhost/Learn-PHP/basic-crud-app/index.php?sort_by=value&sort_order=desc)

### 3. **Chỉnh sửa một mục**

Để chỉnh sửa một mục, bạn cần truyền edit_id vào URL. Dựa trên dữ liệu trong ảnh, bạn có hai mục với ID là 2 và 3. Dưới đây là các liên kết để chỉnh sửa:

- **Chỉnh sửa mục với ID = 2** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?edit_id=2](http://localhost/Learn-PHP/basic-crud-app/index.php?edit_id=2)

- **Chỉnh sửa mục với ID = 3** :

  [http://localhost/Learn-PHP/basic-crud-app/index.php?edit_id=3](http://localhost/Learn-PHP/basic-crud-app/index.php?edit_id=3)

### 4. **Xóa một mục**

Chức năng xóa được thực hiện thông qua form POST trong process.php. Bạn không thể xóa trực tiếp qua URL, nhưng bạn có thể truy cập trang chính và nhấp vào nút "Delete" bên cạnh mục tương ứng. Nút "Delete" sẽ gửi yêu cầu POST tới:

http://localhost/Learn-PHP/basic-crud-app/process.php

với các tham số action=delete và id của mục cần xóa.

### 5. **Tạo một mục mới**

Để tạo một mục mới, bạn chỉ cần truy cập trang chính và điền thông tin vào form, sau đó nhấn nút "Create Item". Form sẽ gửi yêu cầu POST tới:

http://localhost/Learn-PHP/basic-crud-app/process.php

với tham số action=create.

### Lưu ý:

- Đảm bảo server của bạn (ví dụ: XAMPP, WAMP) đang chạy và các file functions.php, process.php, và thư mục basic-php (chứa advanced_function_examples.php) được đặt đúng trong cấu trúc thư mục.
- Nếu bạn gặp lỗi khi truy cập các liên kết, hãy kiểm tra xem các file đã được cập nhật đúng như mã tôi đã cung cấp trước đó hay chưa.

Bạn có thể nhấp vào các liên kết trên để kiểm tra từng tính năng! Nếu cần thêm hỗ trợ, hãy cho tôi biết nhé.
