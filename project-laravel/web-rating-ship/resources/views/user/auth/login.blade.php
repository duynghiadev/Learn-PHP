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
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Đăng nhập</h3></div>
                            <div class="card-body">
                                <form action="{{ route('user.login.store')  }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                        <label for="inputEmail">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                        <label for="inputPassword">Mật khẩu</label>
                                    </div>
                                    @error('login')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div>{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="{{route('user.register.form')}}">Đăng ký tài khoản?</a>
                                        <button class="btn btn-primary" type="submit">Đăng nhập</button>
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
                    <div class="text-muted">Phát triển bởi &copy; NTHN </div>
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
