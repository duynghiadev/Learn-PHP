@extends('admin.layouts.master')

@section('title')
    Thêm mới thương hiệu
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm mới thương hiệu</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.trademarks.index')}}">Thương hiệu</a></li>
            <li class="breadcrumb-item active">Thêm mới thương hiệu</li>
        </ol>
    </div>
    <form id="" class="form" action="{{route('admin.trademarks.store')}}" method="post" style="width: 96%!important; margin: 2%" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-top: 10px">
            <div class="card card-flush py-4">
                <div class="card-body pt-0 row">
                    <div class="col-sm-6">
                        <div class="mb-10 fv-row">
                            <label class="form-label">Tên thương hiệu:</label><span style="color: red;"> *</span>
                            <input type="text" name="name" class="form-control mb-2" placeholder="Nhập tên..." value="{{old('name')}}" />
                            @error('name')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label class="form-label">Slug: </label><span style="color: red;"> *</span>
                            <textarea class="form-control mb-2" style="width:100%;" name="slug" id="" rows="4" placeholder="Nhập mô tả..." >{{old('slug')}}</textarea>
                            @error('slug')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-10">
                            <label class="form-label">Hình ảnh:</label><span style="color: red;"> *</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".png, .jpg, .jpeg" class="custom-file-input" id="listImg" name="images" required>
                                </div>
                            </div>
                            <style>
                                .gallery > img {
                                    width: 300px;
                                    margin-right: 20px;
                                }
                            </style>
                            <div class="gallery d-flex flex-wrap" style="margin-top: 20px;">

                            </div>
                            @error('image')
                            <div style="color: red;" class="">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="margin-top: 20px">
                <a href="{{route('admin.trademarks.index')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-3">Huỷ</a>
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

                    preview.replaceChild(image,preview.childNodes[0]);
                });
                reader.readAsDataURL(file);
            }
        }
        document.querySelector('#listImg').addEventListener("change", previewImages);
    </script>
@endsection
