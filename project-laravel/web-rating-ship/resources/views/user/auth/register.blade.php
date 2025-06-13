<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Đăng nhập</title>
    <link href="/admin/css/styles.css" rel="stylesheet"/>
    <link media="screen" rel="stylesheet" type="text/css" href="/admin/css/toastr/toastr.css"/>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #FFD333">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Đăng ký tài khoản</h3></div>
                            <div class="card-body">
                                <form action="{{ route('user.register.store')  }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-3">
                                        <input name="name" class="form-control" id="inputEmail" type="text" placeholder="" required/>
                                        <label for="inputEmail">Họ tên</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="email" class="form-control" id="inputEmail" type="email" placeholder="" required/>
                                        <label for="inputEmail">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="phone" class="form-control" id="inputEmail" type="text" placeholder="" required/>
                                        <label for="inputEmail">Số điện thoại</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="address" class="form-control" id="inputEmail" type="text" placeholder="" required/>
                                        <label for="inputEmail">Địa chỉ</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="gender" class="form-select form-control" required>
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                        <label for="inputEmail">Giới tính</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="password" class="form-control" id="inputPassword" type="password" placeholder="" required/>
                                        <label for="inputPassword">Mật khẩu</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{route('user.login.form')}}">Bạn đã có tài khoản? Đăng nhập</a>
                                        <button class="btn btn-primary" type="submit">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small">Chào mừng trở lại</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Phát triển bởi &copy; Nguyễn Thị Hằng Nga</div>
                    <div>
                        &copy; 2022
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/admin/js/scripts.js"></script>
<script type="text/javascript" src="/admin/js/toastr/toastr.min.js"></script>
@error('login')
<script>
    toastr.error("{{$message}}");
</script>
@enderror
@if(Session::has('success'))
    <script>
        toastr.success("{!! session()->get('success') !!}");
    </script>
@elseif(Session::has('error'))
    <script>
        toastr.error("{!! session()->get('error') !!}");
    </script>
@endif
</body>
</html>
