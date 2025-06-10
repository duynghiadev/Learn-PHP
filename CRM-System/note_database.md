HỆ THỐNG QUẢN LÝ KHOÁ HỌC

bảng users:

- id int primary key
- fullname varchar 200
- email varchar 100
- phone varchar 50
- address varchar 500
- forget_token varcha 500
- active_token varchar 500
- status int (1: đã kích hoạt, 0: chưa kích hoạt)
- permission text -> id khoá học
- group_id int-> foreign key -> bang groups
- created_at datetime
- updated_at datetime

bảng token_login:

- id int primary key
- user_id int -> foreign key -> bang users
- token varchar 200
- created_at datetime
- updated_at datetime

bảng course:

- id int primary key
- name varchar 100
- slug varchar 100
- category_id int-> foreign key -> bang category
- description text
- price int
- thumnail varchar 200
- created_at datetime
- updated_at datetime

bảng course_category:

- id int primary key
- name varchar 100
- slug varchar 100
- created_at datetime
- updated_at datetime

bảng permission: // hien tai chua su dung

bảng groups:

- id int primary key
- name varchar 100
- created_at datetime
- updated_at datetime
