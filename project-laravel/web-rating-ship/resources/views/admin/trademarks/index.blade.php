@extends('admin.layouts.master')

@section('title')
    Danh sách thương hiệu
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/admin/css/user/index">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .btnAdd{
            position: absolute !important;
            top: 105px !important;
            right: 25px !important;
        }
        #users > tbody > tr > td:nth-child(3),
        #users > tbody > tr > td:nth-child(5),
        #users > tbody > tr > td:nth-child(6) {
            text-align: center !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách thương hiệu</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thương hiệu</li>
        </ol>
        <a class="btn btn-primary btnAdd" href="{{route('admin.trademarks.create')}}">Tạo mới</a>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr style="text-transform: none !important;" class="text-start text-muted fw-bolder fs-7 gs-0">
                        <th class="min-w-125px">Ảnh</th>
                        <th style="text-transform: none !important;" class="min-w-125px">Tên thương hiệu</th>
                        <th style="text-transform: none !important;" class="min-w-125px">Slug</th>
                        <th style="text-transform: none !important;" class="min-w-125px">Ngày tạo</th>
                        <th style="text-align: start;text-transform: none !important;" class="min-w-125px">Chức năng</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">

                    </tbody>
                    <!--end::Table body-->
                </table>
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
        $(function() {
            var table = $('#table').DataTable({
                language: {
                    "decimal":        "",
                    "emptyTable":     "Không có dữ liệu",
                    "info":           "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty":      "Hiển thị 0 đến 0 của 0 mục",
                    "infoFiltered":   "(Được lọc từ _MAX_ tất cả mục)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Hiển thị _MENU_",
                    "loadingRecords": "Đang tải ...",
                    "processing":     "Đang tải ...",
                    "search":         "Tìm kiếm:",
                    "zeroRecords":    "Không có dữ liệu",
                    "aria": {
                        "sortAscending": ": Kích hoạt để sắp xếp cột tăng dần",
                        "sortDescending": ": Kích hoạt để sắp xếp cột giảm dần"
                    }
                },
                processing: true,
                searching: true,
                ordering: false,
                serverSide: true,
                paging: true,
                ajax:{
                    type: "GET",
                    datatype: "json",
                    url: '/admin/trademarks/get-list',
                    data: function (d) {
                        d.search = $('#searchTrademark').val();
                    },
                },
                columns: [
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ]
            });
            $('#searchTrademark').keyup(function(e){
                table.draw();
                e.preventDefault();
            });
        });

        $(document).on('click', '.delete', function (){
            Swal.fire({
                title: 'Bạn có chắc chắn không?',
                text: "Bạn sẽ không khôi phục được dữ liệu",
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#3083D6',
                cancelButtonText: 'Hủy',
                cancelButtonColor: '#F70008',
                confirmButtonText: 'Đồng ý'
            }).then((result)=>{
                if (result.isConfirmed) {
                    var id = $(this).data("id");
                    var $this = $(this);
                    $.ajax({
                        url: "/admin/trademarks/"+id,
                        method: 'DELETE',
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {},
                        success: function (data) {
                            $('#table').DataTable().ajax.reload(null,true);
                            if(data.check !== true){
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Đã xoá thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }else{
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'error',
                                    title: 'Xoá không thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
