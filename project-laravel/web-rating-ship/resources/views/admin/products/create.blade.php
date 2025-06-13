@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm mới sản phẩm</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
        </ol>
    </div>
    <form role="form" action="{{ route('admin.products.store') }}" style="width: 96%!important; margin: 2%" method="POST"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm </label><span style="color: red;"> *</span>
                            <input type="text" class="form-control" id="" name="name" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm" required>
                            @error('name')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label><span style="color: red;"> *</span>
                            <input type="number" class="form-control" value="{{ old('quantity') }}" name="quantity" required
                                   placeholder="Nhập số lượng sản phẩm">

                            @error('quantity')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá gốc</label><span style="color: red;"> *</span>
                            <input type="number" class="form-control" value="{{ old('origin_price') }}" required
                                   name="origin_price" placeholder="Nhập giá gốc">

                            @error('origin_price')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="trademark_id" style="width: 100%;" id="trademark" required>
                                <option value="0">-- Chọn thương hiệu --</option>
                                @foreach($trademarks as $trademark)
                                    <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="category_id" style="width: 100%;" id="category" required>
                                <option value="0">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái sản phẩm</label><span style="color: red;"> *</span>
                            <select class="form-control select2" name="status" style="width: 100%;" required>
                                @foreach(\App\Models\Product::$status_text as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giá bán</label><span style="color: red;"> *</span>
                            <input type="number" class="form-control" value="{{ old('sale_price') }}" required
                                   name="sale_price" placeholder="Nhập giá bán">

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
                                    <input type="file" class="custom-file-input" id="listImg" accept="image/*" name="image[]" multiple required>
                                </div>
                            </div>
                            <style>
                                .gallery > img {
                                    width: 300px;
                                    margin-right: 20px;
                                }
                            </style>
                            <div class="gallery d-flex flex-wrap" style="margin-top: 20px;"></div>
                            @error('image[]')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <textarea class="" id="editor_content" name="description"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

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
                    // image.width = 150;
                    // image.height = 150;
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
