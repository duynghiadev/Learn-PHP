@extends('admin.layouts.master')

@section('title')
    Danh sách người dùng
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
        <h1 class="mt-4">Danh sách người dùng</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Người dùng</li>
        </ol>
        <a class="btn btn-primary btnAdd" href="{{route('admin.users.create')}}">Tạo mới</a>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="users">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 gs-0">
                        <th class="min-w-100px" style="width: 300px">Tên người dùng</th>
                        <th class="min-w-100px " style="width: 200px">Email</th>
                        <th class="min-w-100px text-center" style="width: 230px">Số điện thoại</th>
                        <th class="min-w-190px" style="width: 250px">Địa chỉ</th>
                        <th class="min-w-50px text-center" style="width: 140px">Trạng thái</th>
                        <th class="min-w-150px text-center" style="width: 250px">Hành động</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                    <!--begin::Table row-->

                    <!--end::Table row-->
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
        $(document).ready(function(){
            $(function() {
                var table = $('#users').DataTable({
                    "ordering": false,
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "Không có dữ liệu",
                        "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mục",
                        "infoEmpty":      "Hiển thị 0 đến 0 của 0 mục",
                        "infoFiltered":   "(Được lọc từ _MAX_ tất cả mục)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Hiển thị _MENU_ mục",
                        "loadingRecords": "Đang tải ...",
                        "processing":     "Đang tải ...",
                        "search":         "Tìm kiếm:",
                        "zeroRecords":    "Không có dữ liệu",
                        "aria": {
                            "sortAscending":  ": Kích hoạt để sắp xếp cột tăng dần",
                            "sortDescending": ": Kích hoạt để sắp xếp cột giảm dần"
                        }
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    paging: true,
                    filter: true,
                    ajax:{
                        url: "/admin/users/get-list",
                        data: function (d) {
                            d.status = $('#status').val();
                            d.search = $('#search_users').val();
                        }
                    },
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'phone', name: 'phone' },
                        { data: 'address', name: 'address' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action' },
                    ]
                });

                $('#reset_filter').click(function (){
                    reset();
                    $('#filter_default').attr('selected');

                });
                function reset(e){
                    $('#status').val("");
                    $('#filter_status').submit();
                    table.draw();
                    e.preventDefault();
                }
                $('#filter-form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });

                $("#search_users").keyup(function(e){
                    table.draw();
                    e.preventDefault();
                });
            });
        });
        $(document).on('click','.status_check',function(){
            Swal.fire({
                title: 'Bạn có chắn chắn không?',
                text: "Xác nhận thực hiện",
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Xác nhận'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    var id = $(this).data('id');
                    var $this = $(this);
                    $.ajax({
                        url:'/admin/users/lock/'+id,
                        type:'put',
                        dataType: "JSON",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success:function(data){
                            if(data.status==200){
                                if(data.user_status){
                                    $('#users').DataTable().ajax.reload( null, false );
                                    Swal.fire({
                                        position: 'center-center',
                                        icon: 'success',
                                        title: 'Mở thành công',
                                        showConfirmButton: false,
                                        timer: 1800
                                    });
                                }else{
                                    $('#users').DataTable().ajax.reload( null, false );
                                    Swal.fire({
                                        position: 'center-center',
                                        icon: 'success',
                                        title: 'Khoá thành công',
                                        showConfirmButton: false,
                                        timer: 1800
                                    });
                                }

                            }
                        }
                    });

                }
            });
        });
        $(document).on('click', '.show_confirm', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn không?',
                text: "Bạn sẽ không khôi phục được lại dữ liệu",
                icon: 'warning',
                reverseButtons: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Xoá'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    //   form.submit();
                    var id = $(this).data("id");
                    var $this = $(this);
                    $.ajax(
                        {
                            url: "/admin/users/"+id,
                            method: 'DELETE',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {

                            },
                            success: function (data)
                            {
                                if(data.status==200){
                                    $('#users').DataTable().ajax.reload( null, false );
                                    Swal.fire({
                                        position: 'center-center',
                                        icon: 'success',
                                        title: 'Đã xoá thành công',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            },
                            error: function ()
                            {
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'error',
                                    title: 'Xoá thất bại!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                }
            });
        });
        $(document).on('click', '.reset_pass', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn không?',
                text: 'Mật khẩu sẽ reset về mặc định: 123456',
                icon: 'warning',
                reverseButtons: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Xác nhận'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    var id = $(this).data("id");
                    var $this = $(this);
                    $.ajax(
                        {
                            url: "/admin/users/reset-password/"+id,
                            type: 'POST',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {

                            },
                            success: function (data)
                            {
                                if(data.status==200){
                                    Swal.fire({
                                        position: 'center-center',
                                        icon: 'success',
                                        title: 'Đã reset mật khẩu thành công',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            },
                            error: function ()
                            {
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'error',
                                    title: 'Reset mật khẩu thất bại!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                }
            });
        });
        $(document).on('click', '.lock', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn không?',
                text: "Xác nhận thực hiện",
                icon: 'warning',
                reverseButtons: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Xác nhận'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    var id = $(this).data("id");
                    var $this = $(this);
                    $.ajax(

                        {
                            url: "/admin/staffs/lock/"+id,
                            type: 'POST',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {

                            },
                            success: function (data)
                            {
                                if(data.status==200){
                                    if(data.staff_status){
                                        $('#staffs').DataTable().ajax.reload( null, false );
                                        Swal.fire({
                                            position: 'center-center',
                                            icon: 'success',
                                            title: 'Đã khoá tài khoản',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }else{
                                        $('#staffs').DataTable().ajax.reload( null, false );
                                        Swal.fire({
                                            position: 'center-center',
                                            icon: 'success',
                                            title: 'Đã mở khoá tài khoản',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                }
                            },
                            error:function ()
                            {
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'error',
                                    title: 'Thao tác thất bại!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                }
            });
        });
    </script>
@endsection
