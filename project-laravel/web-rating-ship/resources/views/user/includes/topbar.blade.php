<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            @if(Auth::guard('web')->user())
            Xin chào, {{Auth::guard('web')->user()->name}}
            @endif
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Tài khoản</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(\Illuminate\Support\Facades\Auth::guard('web')->user())
                            <a href="{{route('home.account')}}" class="dropdown-item" type="button">Quản lý tài khoản</a>
                            <a href="{{route('user.logout')}}" class="dropdown-item" type="button">Đăng xuất</a>
                        @else
                            <a href="{{route('user.login.form')}}" class="dropdown-item" type="button">Đăng nhập</a>
                            <a href="{{route('user.register.form')}}" class="dropdown-item" type="button">Đăng ký</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Cosmetic</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{route('home.search')}}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="keywords" placeholder="Tìm kiếm sản phẩm">
                    <div class="input-group-append">
                        <input type="submit" name="search_items" class="btn btn-warning" value="Tìm Kiếm">    
                        {{-- <a href="{{route('hdome.search')}}">Tìm Kiếm</a> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Hỗ trợ 24/7</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
