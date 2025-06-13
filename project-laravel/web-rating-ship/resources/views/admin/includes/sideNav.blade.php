<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Trang chủ
                </a>
                <div class="sb-sidenav-menu-heading">Hệ thống</div>
                <a class="nav-link" href="{{route('admin.users.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý người dùng
                </a>
                <div class="sb-sidenav-menu-heading">Khách hàng</div>
                <a class="nav-link" href="{{route('admin.customers.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý khách hàng
                </a>
                <a class="nav-link" href="{{route('admin.comment.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                    Quản lý bình luận
                </a>
                <div class="sb-sidenav-menu-heading">Vận chuyển</div>
                <a class="nav-link" href="{{route('admin.transport.create')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Thêm vận chuyển
                </a>
                <div class="sb-sidenav-menu-heading">Sản phẩm</div>
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý danh mục
                </a>
                <a class="nav-link" href="{{route('admin.products.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý sản phẩm
                </a>
                <a class="nav-link" href="{{route('admin.trademarks.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý thương hiệu
                </a>
                <a class="nav-link" href="{{route('admin.coupon.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý mã giảm giá
                </a>
                <div class="sb-sidenav-menu-heading">Đơn hàng</div>
                <a class="nav-link" href="{{route('admin.orders.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Quản lý đơn hàng
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Xin chào:</div>
            {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
        </div>
    </nav>
</div>
