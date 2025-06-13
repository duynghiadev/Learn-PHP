@extends('admin.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Trang chủ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><b><i>Hệ thống trang chủ website bán mỹ phẩm</i></b></li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        Tổng doanh thu
                        <h2>{{ 7560000 }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        Đơn hàng
                        <h2>{{ $orders }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.orders.index') }}">
                            Chi tiết đơn hàng
                        </a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        Sảm phẩm
                        <h2>{{ $products }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.products.index') }}">Tất cả sản
                            phẩm</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        Danh mục
                        <h2>{{ $categories }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('admin.categories.index') }}">Các hạng
                            mục</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h3 class="mt-4 title_thongkedoanhso" style="text-align: center; color:rgb(100, 230, 237);">---Biểu đồ thống kê
                doanh số---</h3>
            <form action="" autocomplete="off" style="margin-right: 20px; display:flex;" method="POST">
                @csrf
                <div class="col-md-2" style="margin-right: 20px;">
                    <p>Từ ngày: <input type="text" id="datepicker1" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                </div>
                <div class="col-md-2" style="margin-right:20px;">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

                </div>
                <div class="col-md-2">
                    <p>Lọc theo
                        <select name="" class="dashboard-filter form-control">
                            <option>Chọn</option>
                            <option value="tuan">Thống kê 7 ngày</option>
                            <option value="thangtruoc">Thống kê tháng trước</option>
                            <option value="thangnay">Thống kê thời điểm hiện tại</option>
                            <option value="nam">Thống kê theo năm</option>
                        </select>
                    </p>
                </div>

            </form>
            <p></p>
            <div class="col-md-12">
                <div id="chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        $(document).ready(function() {
            var chart = new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'chart',

                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                //3 cái dưới dùng cho Line, Area

                // pointFillColors:['#ffffff'],
                // pointStrokeColors: ['blue'],
                // fillOpacity: 0.3,
                hideHover: 'auto',
                parseTime: false,
                data: [{
                        period: '2008',
                        value: 20
                    },
                    {
                        period: '2009',
                        value: 10
                    },
                    {
                        period: '2010',
                        value: 5
                    },
                    {
                        period: '2011',
                        value: 5
                    },
                    {
                        period: '2012',
                        value: 20
                    }
                ],
                // The name of the data record attribute that contains x-values.
                xkey: 'period',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['order', 'revenue', 'profit', 'quantity'],
                behaveLikeLine: true,
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
            });

            $("#datepicker1").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });

            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });

            $('#btn-dashboard-filter').click(function() {
                // alert('suscessful');
                var _token = $('input[ name = "_token" ]').val();
                var from_date = $('#datepicker1').val();
                var to_date = $('#datepicker2').val();
                // alert(from_date);
                // alert(to_date);

                $.ajax({
                    url: "{{ url('/filter-by-date') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });

            $('#dashboard-filter').chage(function() {

                var dashboard_value = $(this).val();
                var _token = $('input[ name = "_token" ]').val();

                alert(dashboard_value);

                $.ajax({
                    url: "{{ url('/dashboard-filter') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });

        });
    </script>
@endsection
