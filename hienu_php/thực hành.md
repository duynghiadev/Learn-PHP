Thực hành xây dựng chức năng quản lý người dùng:

Phần 1 : Xác thực truy cập

- Đăng nhập
- Đăng Ký
- Đăng xuất
- Quên mật khẩu
- Kích hoạt tài khoản

Phần 2 : quản lý người dùng

- kiểm tra người dùng đăng nhập
- thêm người dùng
- sửa và xoá người dùng
- hiển thị số users
- phân trang
- tìm kiếm, lọc dữ liệu

Thiết kế database:

- Bảng users:
+ id - primary key (int)
+ fullname (varchar(100))
+ email (varchar(100))
+ phone (varchar(20))
+ password (varchar(50))
+ forgotToken (varchar(100))
+ activeToken (varchar(100))
+ create_at (datetime)
+ update_at (datetime)

- Bảng loginToken:
+ id - primary key (int)
+ user_Id (int)
+ token varchar(100)
+ create_at (datetime)


* Code chức năng đăng ký tài khoản
- Đăng ký (kiểm tra và insert dữ liệu vào bảng users)
- Gửi mail kích hoạt cho người dùng
- Người dùng bấm vào link kích hoạt tài khoản (Mã OTP)


*Code tính năng quên mật khẩu
- tạo ra forgot token
- Gửi email chứa link đến trang reset
- Xác thực token, hiện ra form reset password
- Submit reset password -> xử lý -> update lại mật khẩu.