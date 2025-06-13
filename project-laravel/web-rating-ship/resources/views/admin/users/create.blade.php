@extends('admin.layouts.master')

@section('title')
    Thêm mới người dùng
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm mới người dùng</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.users.index')}}">Người dùng</a></li>
            <li class="breadcrumb-item active">Thêm mới người dùng</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.users.store')}}" method="post" style="width: 96%!important; margin: 2%">
        @csrf
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="mb-10 fv-row">
                            <label class="form-label">Tên:</label><span style="color: red;"> *</span>
                            <input type="text" name="name" class="form-control mb-2" placeholder="Nhập tên..." value="{{old('name')}}" />
                            @error('name')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Email:</label><span style="color: red;"> *</span>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Nhập email..." value="{{old('email')}}" />
                            @error('email')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Số điện thoại:</label><span style="color: red;"> *</span>
                            <input type="text" name="phone" class="form-control mb-2" placeholder="Nhập số điện thoại..." value="{{old('phone')}}" />
                            @error('phone')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Mật khẩu:</label><span style="color: red;"> *</span>
                            <input type="password" name="password" class="form-control mb-2" placeholder="Nhập mật khẩu..." value="{{old('password')}}" />
                            @error('password')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Địa chỉ: </label><span style="color: red;"> *</span>
                            <textarea class="form-control mb-2" style="width:100%;" name="address" id="" rows="4" placeholder="Nhập địa chỉ..." >{{old('address')}}</textarea>
                            @error('address')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.users.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Lưu</span>
                </button>
            </div>
        </div>
    </form>
@endsection
