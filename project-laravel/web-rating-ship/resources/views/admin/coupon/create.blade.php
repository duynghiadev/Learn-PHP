@extends('admin.layouts.master')

@section('title')
    Thêm mới mã giảm giá
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tạo mã giảm giá</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.coupon.index')}}">Mã giảm giá</a></li>
            <li class="breadcrumb-item active">Thêm mới mã giảm giá</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.coupon.store')}}" method="post" style="width: 96%!important; margin: 2%" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="mb-10 fv-row">
                            <label class="form-label">Tên mã giảm giá:</label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_name" class="form-control mb-2" placeholder="Nhập tên..." value="{{old('coupon_name')}}" />
                            @error('coupon_name')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Mã giảm giá: </label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_code" class="form-control mb-2" placeholder="Nhập mã giảm giá..." value="{{old('coupon_code')}}" />
                            @error('coupon_code')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Số lượng: </label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_times" class="form-control mb-2" placeholder="Nhập số lượng mã giảm giá..." value="{{old('coupon_times')}}" />
                            @error('coupon_times')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Tính năng: </label><span style="color: red;"> *</span>
                            <select name="coupon_condition" class="form-control mb-2">
                                <option>-----Chọn-----</option>
                                <option value="{{\App\Models\Coupon::TYPE['PERCENT']}}">---Giảm theo phần trăm---</option>
                                <option value="{{\App\Models\Coupon::TYPE['MONEY']}}">---Giảm theo tiền mặt---</option>
                            </select>
                            @error('coupon_condtion')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Số % / tiền giảm: </label><span style="color: red;"> *</span>
                            <input type="text" name="coupon_number" class="form-control mb-2" placeholder="Nhập số phần trăm hoặc số tiền giảm..." value="{{old('coupon_number')}}" />
                            @error('coupon_number')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Ngày bắt đầu: </label><span style="color: red;"> *</span>
                            <input type="date" name="start_time" class="form-control mb-2" placeholder="Nhập ngày mã bắt đầu áp dụng..." value="{{old('start_time')}}" />
                            @error('start_time')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Ngày kết thúc: </label><span style="color: red;"> *</span>
                            <input type="date" name="end_time" class="form-control mb-2" placeholder="Nhập ngày kết thúc áp dụng mã..." value="{{old('end_time')}}" />
                            @error('end_time')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.coupon.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Lưu</span>
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    
@endsection
