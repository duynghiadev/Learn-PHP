@extends('user.layouts.master')

@section('title')
    Thanh toán
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="{{route('home.listProduct')}}">Sản phẩm</a>
                    <a class="breadcrumb-item text-dark" href="{{route('user.product.cart')}}">Giỏ hàng</a>
                    <span class="breadcrumb-item active">Thanh toán</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form action="{{route('home.order')}}" method="post">
            @csrf
        <div class="row">
                <div class="col-lg-6">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thông tin khách hàng</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Họ tên</label>
                                <input name="name" class="form-control" type="text" value="{{Auth::user()->name}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>E-mail</label>
                                <input name="email" class="form-control" type="text" value="{{Auth::user()->email}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Số điện thoại</label>
                                <input name="phone" class="form-control" type="text" value="{{Auth::user()->phone}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Địa chỉ giao hàng</label>
                                <input name="address" class="form-control" type="text" value="{{Auth::user()->address}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Lời nhắn</label>
                                <textarea name="note" class="form-control" type="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thông tin đơn hàng</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Danh sách sản phẩm</h6>
                            @foreach ($products as $product)
                                <div class="d-flex justify-content-between row">
                                    <p class="col-8">{{$product->name}}</p>
                                    <p class="col-2">{{$product->qty}}</p>
                                    <div class="col-2">
                                        <p  style="float: right">{{number_format($product->price*$product->qty,0, ',', '.')}}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            @php 
                                $total_cart = (int)Cart::subtotal(null,null,'');
                                $percent_sale = 0;
                                $total_coupon = 0;
                                $total_money = $total_cart-$total_coupon;
                            @endphp

                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    @php 
                                    if ($cou['coupon_condition']==1) {
                                        $percent_sale = (int)$cou['coupon_number'];
                                        $total_coupon = ($total_cart*((int)$cou['coupon_number']))/100;
                                    } else{
                                        $total_coupon = $cou['coupon_number'];
                                    }
                                    $total_money = $total_cart-$total_coupon
                                    @endphp
                                @endforeach
                            @endif 
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Tổng hoá đơn</h6>
                                <h6>{{number_format($total_cart)}}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Áp dụng mã giảm giá</h6>
                                <h6 class="font-weight-medium">{{number_format($total_coupon)}}
                                </h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí vận chuyển</h6>
                                <h6 class="font-weight-medium">0</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Tổng thanh toán</h5>
                                <h5>{{number_format($total_money)}}</h5>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Hình thức thanh toán</h5><br>
                            </div>
                        </div>
                        <div class="transfer">
                            <input
                                type="radio" id="f-option" class="circle-1"
                                onclick="myFunction()"
                                style="height: 18px;width: 20px;cursor: pointer"
                                checked value="0" name="payment_type" >
                            <label
                                class="pay-text" for="myCheck">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                                Thanh toán khi nhận hàng
                            </label>

                        </div>
                        <div class="vnPay" >
                            <input
                                type="radio" id="g-option" class="circle-2"
                                onclick="checkVnpay()" style="height: 18px;width: 20px;cursor: pointer"
                                value="1" name="payment_type">
                            <label
                                class="pay-text"> <img style="width: 20%;" src="https://vnpay.vn/_nuxt/img/logo-primary.55e9c8c.svg" />
                                Thanh toán bằng VNPAY
                            </label>
                        </div>
                        <div class="vnPay" >
                            <input
                                type="radio" id="g-option" class="circle-2"
                                onclick="checkMoMo()" style="height: 18px;width: 20px;cursor: pointer"
                                value="1" name="payment_type">
                            <label
                                class="pay-text"> <img style="width: 20%;" src="" />
                                Thanh toán bằng MOMO
                            </label>
                        </div>
                        <button type="submit" style="margin-top: 15px" class="btn btn-block btn-primary font-weight-bold py-3">Đặt hàng</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

@endsection
@section('js')
    <script>
        function myFunction() {
            var checkBox = document.getElementById("f-option");
            var checkBox2 = document.getElementById("g-option");
            var text = document.getElementById("text");
            if (checkBox.checked == true){
                text.style.display = "block";
                return true;
            }else if(checkBox2.checked == true) {
                text.style.display = "none";
            }

        }

        function  checkVnpay() {
            var checkBox2 = document.getElementById("g-option");
            var text = document.getElementById("text");
            if (checkBox2.checked == true){
                text.style.display = "none";
                return true;
            }
        }
    </script>
@endsection
