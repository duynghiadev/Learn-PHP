@extends('user.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .active{
            display: block;
        }
        .required{
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home')}}">Trang chủ</a>
                    <span class="breadcrumb-item active">Tài khoản</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'London')">Thông tin cá nhân</button>
                    <button class="tablinks active"  onclick="openCity(event, 'Paris')">Đơn hàng</button>
                </div>
                <div id="London" class="tabcontent">
                    <div class="row">
                        <div class="col-lg-6">
                        <form action="" method="post">
                            @csrf
                                <div class="bg-light p-30">
                                    <h5 class="section-title text-uppercase text-center mb-3"><span class=" pr-3">Thông tin cá nhân</span></h5>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Họ tên <span class="required">*</span></label>
                                            <input name="name" class="form-control" type="text" value="{{Auth::user()->name}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>E-mail <span class="required">*</span></label></label>
                                            <input name="email" class="form-control" type="text" value="{{Auth::user()->email}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Số điện thoại <span class="required">*</span></label></label>
                                            <input name="phone" class="form-control" type="text" value="{{Auth::user()->phone}}" required>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Địa chỉ giao hàng <span class="required">*</span></label></label>
                                            <input name="address" class="form-control" type="text" value="{{Auth::user()->address}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit" style="margin-left: 15px; width: 100px;height:60px;float:right" class="btn  btn-primary font-weight-bold">Cập nhật</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                        <div class="col-lg-6">
                        <form action="" method="post">
                            @csrf
                            <div class="bg-light p-30">
                                <h5 class="section-title text-center text-uppercase mb-3"><span class=" pr-3">Cập nhật mật khẩu</span></h5>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Nhập mật khẩu cũ <span class="required">*</span></label></label>
                                        <input name="oldPassword" class="form-control" type="password"  required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Nhập mật khẩu mới <span class="required">*</span></label></label>
                                        <input name="newPassword" class="form-control" type="password"  required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Xác nhận mật khẩu mới <span class="required">*</span></label></label>
                                        <input name="confirmPassword" class="form-control" type="password"  required>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" style="margin-left: 15px;width: 100px;height:60px;float:right" class="btn btn-block btn-primary font-weight-bold py-3">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div id="Paris" class="tabcontent active">
                    @foreach($orders as $order)
                       <div class="row bg-light ml-1 mr-1 mb-10 p-10" style="padding: 10px;margin-bottom: 20px;display: block">
                           <div class="row">
                               <div class="col-11">
                                   <div class="row" style="margin-left: 0;">
                                       <p>Mã đơn hàng: {{$order->id}}</p>
                                       @if($order->status === \App\Models\Order::WAIT)
                                           <span style="margin-left: 20px;background: orange;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                       {{$order->status_text}}
                                   </span>
                                       @elseif($order->status === \App\Models\Order::CONFIRM)
                                           <span style="margin-left: 20px;background: dodgerblue;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                       {{$order->status_text}}
                                   </span>
                                       @elseif($order->status === \App\Models\Order::REQUESTCANEL)
                                           <span style="margin-left: 20px;background: darkgray;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                       {{$order->status_text}}
                                   </span>
                                       @elseif($order->status === \App\Models\Order::CANCEL)
                                           <span style="margin-left: 20px;background: red;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                       {{$order->status_text}}
                                   </span>
                                       @elseif($order->status === \App\Models\Order::SHIPPING)
                                           <span style="margin-left: 20px;background: blueviolet;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                       {{$order->status_text}}
                                   </span>
                                       @else
                                           <span style="margin-left: 20px;background: limegreen;height: 22px;border-radius: 6px;padding: 0 2px;color: black;">
                                   {{$order->status_text}}
                                   </span>
                                       @endif
                                   </div>
                                   @foreach($order->order_details as $product)
                                       <div class="row" style="border-bottom: 1px solid lightgray;margin: 2px 4px">
                                           <div class="col-1">
                                               <img style="height: 100px;width: 100px" src="{{$product->product->images[0]->image_url}}" alt="ảnh">
                                           </div>
                                           <div class="col-11">
                                               <span>Tên sản phẩm: {{$product->product_name}}</span><br>
                                               <span>Số lượng: {{$product->product_quantity}}</span><br>
                                               <span>Giá bán: {{number_format($product->product_sale_price,0, ',', '.')}} đ</span><br>
                                               <span>Tổng tiền: {{number_format($product->total,0, ',', '.')}} đ</span><br>

                                           </div>
                                       </div>
                                    @endforeach
                               </div>
                               <div class="col-1">
                                       @if($order->status===\App\Models\Order::WAIT || $order->status===\App\Models\Order::CONFIRM)
                                       <form action="{{route('home.cancelOrder',$order->id)}}" method="post">
                                           @csrf
                                           <button type="submit" style="margin-left: 15px;width: 50px;height: 40px;float: right;background: red;font-weight: normal !important;" class="btn  btn-primary font-weight-bold">Huỷ</button>
                                       </form>
                                           @elseif($order->status===\App\Models\Order::REQUESTCANEL)
                                       <form action="{{route('home.undoCancel',$order->id)}}" method="post">
                                           @csrf
                                           <button  type="submit" style="margin-left: 15px;width: 100px;height: 40px;float: right;background: darkgray;font-weight: normal !important;" class="btn  btn-primary font-weight-bold">Dừng huỷ</button>
                                       </form>
                                   @endif
                               </div>
                           </div>
                        
                       </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection
