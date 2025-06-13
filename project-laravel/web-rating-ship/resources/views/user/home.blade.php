@extends('user.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="https://bizweb.dktcdn.net/100/376/405/files/nhuong-quyen-gia-cong-my-pham-blog-coanmy-5-266bfc33-a35b-46d7-b0a2-9f8c3816676b.jpg?v=1596804140468" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Mỹ phẩm chính hãng</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Mỹ phẩm chính hãng nam nữ nhập khẩu</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="http://cdn.tgdd.vn/Files/2021/03/16/1335716/top-8-thuong-hieu-my-pham-viet-nam-tot-nhat-hien-nay-202103161559257688.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Vẻ đẹp vượt thời gian</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Mỹ phẩm Hàn Quốc, Anh, Pháp, Đức, Mỹ, nội địa Trung nhập khẩu, xách tay</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="https://image.thanhnien.vn/w1024/Uploaded/2022/puqgfdmzs-co/2021_10_22/mai-han-duoc-my-pham-2-4439.png" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Chăm sóc làn da của bạn</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Thương hiệu nổi tiếng như: Clinique, Givenchy, Lancome, Whoo,..</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="https://image.thanhnien.vn/w1024/Uploaded/2022/puqgfdmzs-co/2021_10_22/mai-han-duoc-my-pham-2-4439.png" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Chăm sóc da tại nhà</h6>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="http://cdn.tgdd.vn/Files/2021/03/16/1335716/top-8-thuong-hieu-my-pham-viet-nam-tot-nhat-hien-nay-202103161559257688.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Hiểu làn da của bạn</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Danh mục sản phẩm</span></h2>
        <div class="row px-xl-5 pb-3">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="{{$category->image_url}}" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>{{$category->name}}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm bán chạy</span></h2>
        <div class="row px-xl-5">
            @foreach($product_sellings as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <a href="{{route('home.show',$product->id)}}">
                            <img class="w-100" style="height: 400px !important"  src="{{$product->images[0]->image_url}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{route('user.product.add',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('home.show',$product->id)}}"><i class="far fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            </div>
                        </a>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate"  href="{{route('home.show',$product->id)}}">
                            @php     
                            if (strlen($product->name)>50) {
                                $str = substr($product->name, 0,50);
                                $product->name =  $str. '...';
                            };
                            @endphp
                            {{$product->name}}
                        </a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{number_format($product->sale_price,0, ',', '.')}}</h5><h6 class="text-muted ml-2"><del>{{number_format($product->sale_price+50000,0, ',', '.')}}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm mới</span></h2>
        <div class="row px-xl-5">
            @foreach($product_news as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <a href="{{route('home.show',$product->id)}}">
                                <img class=" w-100" style="height: 400px !important"   src="{{$product->images[0]->image_url}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user.product.add',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('home.show',$product->id)}}"><i class="far fa-eye"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"  href="{{route('home.show',$product->id)}}"> 
                                @php     
                                if (strlen($product->name)>50) {
                                    $str = substr($product->name, 0,50);
                                    $product->name =  $str. '...';
                                };
                                @endphp
                                {{$product->name}}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{number_format($product->sale_price,0, ',', '.')}}</h5><h6 class="text-muted ml-2"><del>{{number_format($product->sale_price+50000,0, ',', '.')}}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(Session::has('success'))
        <script>
            toastr.success("{!! session()->get('success') !!}");
        </script>
    @elseif(Session::has('error'))
        <script>
            toastr.error("{!! session()->get('error') !!}");
        </script>
    @endif
@endsection
