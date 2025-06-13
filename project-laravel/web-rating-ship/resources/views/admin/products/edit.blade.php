@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa sản phẩm
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Chỉnh sửa sản phẩm</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.categories.index')}}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.products.update',$product->id)}}" method="post" style="width: 96%!important; margin: 2%" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put">
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm </label><span style="color: red;"> *</span>
                            <input type="text" class="form-control" id="" name="name"  value="@if(!empty(old("name"))){{old("name")}}@else {{$product->name}}@endif" placeholder="Nhập tên sản phẩm" required>
                            @error('name')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label><span style="color: red;"> *</span>
                            <input class="form-control"  value="@if(!empty(old("quantity"))){{old("quantity")}}@else {{$product->quantity}}@endif" name="quantity" required
                                   placeholder="Nhập số lượng sản phẩm">

                            @error('quantity')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá gốc</label><span style="color: red;"> *</span>
                            <input class="form-control"  value="@if(!empty(old("origin_price"))){{old("origin_price")}}@else {{$product->origin_price}}@endif" required name="origin_price" placeholder="Nhập giá gốc">
                            @error('origin_price')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="trademark_id"  style="width: 100%;" id="trademark" required>
                                <option value="0">-- Chọn thương hiệu --</option>
                                @foreach($trademarks as $item)
                                    @php
                                        $selected="";
                                        if($product->trademark_id == $item->id){
                                          $selected = "selected";
                                        }
                                    @endphp
                                    <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="category_id"  style="width: 100%;" id="category" required>
                                <option value="0">-- Chọn danh mục --</option>
                                @foreach($categories as $item)
                                    @php
                                        $selected="";
                                        if($product->category_id == $item->id){
                                          $selected = "selected";
                                        }
                                    @endphp
                                    <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái sản phẩm</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="status" style="width: 100%;" required>
                                @foreach(App\Models\Product::$status_text as $key => $value)
                                    @php
                                        $selected="";
                                        if($product->status == $key){
                                          $selected = "selected";
                                        }
                                    @endphp
                                    <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Giá bán</label><span style="color: red;"> *</span>
                            <input class="form-control"  value="@if(!empty(old("sale_price"))){{old("sale_price")}}@else {{$product->sale_price}}@endif" required name="sale_price" placeholder="Nhập giá bán">
                            @error('sale_price')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh sản phẩm</label><span style="color: red;"> *</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="listImg" accept="image/*" name="image[]" multiple>
                                </div>
                            </div>
                            <style>
                                .gallery > img {
                                    width: 300px;
                                    margin-right: 20px;
                                }
                            </style>
                            <div class="gallery d-flex flex-wrap" style="margin-top: 20px;">
                                    @foreach($product->images as $image)
                                    <img src="{{$image->image_url}}" alt="">
                                    @endforeach
                            </div>
                            @error('image[]')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <textarea class="" id="editor_content" name="description"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$product->description}}}</textarea>

                            @error('content')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.products.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Lưu</span>
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function previewImages() {
            var preview = document.querySelector('.gallery');

            if (this.files) {
                [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                }

                var reader = new FileReader();

                reader.addEventListener("load", function () {
                    var image = new Image();
                    image.title = file.name;
                    image.src = this.result;

                    preview.appendChild(image);
                });

                reader.readAsDataURL(file);

            }
        }

        document.querySelector('#listImg').addEventListener("change", previewImages);
    </script>
@endsection
