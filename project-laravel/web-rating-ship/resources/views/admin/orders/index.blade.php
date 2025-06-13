@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng
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
        #orders > tbody > tr > td:nth-child(1),
        #orders > tbody > tr > td:nth-child(4),
        #orders > tbody > tr > td:nth-child(5),
        #orders > tbody > tr > td:nth-child(8),
        #orders > tbody > tr > td:nth-child(7),
        #orders > tbody > tr > td:nth-child(6) {
            text-align: center !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách đơn hàng</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Đơn hàng</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="orders" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 gs-0">
                        <th class="min-w-125px" style="text-align: center">Mã đơn hàng</th>
                        <th class="min-w-125px">Khách hàng</th>
                        <th class="min-w-125px" >Tổng tiền</th>
                        <th class="min-w-125px" style="text-align: center">Hình thức thanh toán</th>
                        <th class="min-w-125px" style="text-align: center">Trạng thái</th>
                        <th class="min-w-125px">Người xác nhận</th>
                        <th class="min-w-125px" style="text-align: center">Ngày tạo</th>
                        <th
                            style="text-align: center;padding-left: 26px;text-transform: none !important;" class="min-w-125px">
                            Chức năng
                        </th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
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
            $(function () {
                var table = $('#orders').DataTable({
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "Không có dữ liệu",
                        "info":           "Hiển thị _START_ to _END_ of _TOTAL_ mục",
                        "infoEmpty":      "Hiển thị 0 to 0 of 0 mục",
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
                    searching: true,
                    ordering: false,
                    serverSide: true,
                    paging: true,
                    ajax:{
                        url: "/admin/orders/get-list",
                        data: function (d) {
                            d.status = $('#status').val();
                            d.search = $('#search_orders').val()
                        }
                    },
                    columns: [
                        { data: 'id' , name: 'id' },
                        { data: 'customer_id' , name: 'customer_id' },
                        { data: 'total', name: 'total' },
                        { data: 'payment_text', name: 'payment_text' },
                        { data: 'status', name: 'status' },
                        { data: 'update_by', name: 'update_by' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action' },
                    ]
                });

                $('#reset_fllter').click(function (){
                    reset();
                    $('#fillter_default').attr('selected');

                });
                function reset(e){
                    $('#status').val("");
                    table.draw();
                    e.preventDefault();
                }
                $('#fillter-form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });

                $("#search_orders").keyup(function(e){
                    table.draw();
                    e.preventDefault();
                });
            });
        });

        $(document).on('click', '.confirmOrder', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn xác nhận không?',
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
                            url: '/admin/orders/change-status/'+id,
                            type: 'post',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 1
                            },
                            success: function (data)
                            {
                                $('#orders').DataTable().ajax.reload(null,true);
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Xác nhận thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },

                        });
                }
            });
        });

        $(document).on('click', '.cancelOrder', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn huỷ không?',
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
                            url: '/admin/orders/change-status/'+id,
                            type: 'post',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 3
                            },
                            success: function (data)
                            {
                                $('#orders').DataTable().ajax.reload(null,true);
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Huỷ đơn hàng thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },

                        });
                }
            });
        });

        $(document).on('click', '.shipping', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn cập nhật trạng thái không?',
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
                            url: '/admin/orders/change-status/'+id,
                            type: 'post',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 4
                            },
                            success: function (data)
                            {
                                $('#orders').DataTable().ajax.reload(null,true);
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Cập nhật trạng thái thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },

                        });
                }
            });
        });

        $(document).on('click', '.complete', function (){
            Swal.fire({
                title: 'Bạn có chắn chắn xác nhận hoàn thành đơn hàng?',
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
                            url: '/admin/orders/change-status/'+id,
                            type: 'post',
                            dataType: "JSON",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: 5
                            },
                            success: function (data)
                            {
                                $('#orders').DataTable().ajax.reload(null,true);
                                Swal.fire({
                                    position: 'center-center',
                                    icon: 'success',
                                    title: 'Cập nhật trạng thái thành công',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            },

                        });
                }
            });
        });
    </script>
@endsection
