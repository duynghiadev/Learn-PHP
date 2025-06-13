@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Tours</h3>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Lịch trình</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Giá tour</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Phương tiện</th>
                        <th scope="col">Mã tour</th>
                        <th scope="col">Image</th>
                        <th scope="col">Mô tả</th>
                        {{-- <th scope="col">Slug tour</th> --}}
                        <th scope="col">Ngày đi</th>
                        {{-- <th scope="col">Ngày về</th> --}}
                        <th scope="col">Nơi đi</th>
                        {{-- <th scope="col">Nơi đến</th> --}}
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $key => $tour)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <th scope="row"><a href="{{ route('gallery.edit', [$tour->id]) }}">Thêm ảnh</a></th>
                            <th scope="row"><a href="{{ route('schedule.edit', [$tour->id]) }}">Thêm lịch trình</a></th>
                            <td>{{ $tour->title }}</td>
                            <td>{{ $tour->category->title }}</td>
                            <td>{{ number_format($tour->price, 0, ',', '.') }}vnd
                                <button type="button" data-tour_id="{{ $tour->id }}"
                                    class="btn btn-primary btn-create-price" data-toggle="modal" data-target="#themgia">
                                    Thêm giá tour
                                </button>

                            </td>
                            <td>{{ $tour->quantity }}</td>
                            <td>{{ $tour->vehicle }}</td>
                            <td>{{ $tour->tour_code }}</td>
                            <td><img height="120" width="120" src="{{ asset('uploads/tours/' . $tour->image) }}"></td>
                            <td>{{ $tour->description }}</td>
                            {{-- <td>{{ $tour->slug }}</td> --}}
                            <td>
                                @php
                                    // Convert the string into an array by splitting on commas
                                    $departureDates = explode(', ', $tour->departure_date);
                                @endphp

                                @if (!empty($departureDates))
                                    @foreach ($departureDates as $date)
                                        <span class="badge rounded-pill bg-primary">{{ $date }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No departure dates available</span>
                                @endif
                            </td>

                            {{-- <td>{{ $tour->return_date }}</td> --}}
                            <td>{{ $tour->tour_from }}</td>
                            {{-- <td>{{ $tour->tour_to }}</td> --}}

                            <td>{{ $tour->created_at }}</td>

                            <td>
                                @if ($tour->status == 1)
                                    <span class="text text-success">Active</span>
                                @else
                                    <span class="text text-success">Unactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tours.edit', [$tour->id]) }}" class="btn btn-warning">Edit</a>
                                <form onsubmit="return confirm('Bạn có muốn xóa không?');"
                                    action="{{ route('tours.destroy', [$tour->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Xóa">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Thêm giá tour -->
    <div class="modal fade" id="themgia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm giá cho tour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tourprice.store') }}" method="POST">
                        @csrf

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Giá người lớn</th>
                                    <th scope="col">Giá trẻ em 6 - 11 tuổi</th>
                                    <th scope="col">Giá trẻ em 5 tuổi</th>
                                    <th scope="col">Giá trẻ em < 2 tuổi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="tour_date" id="tour-date-select" class="form-control">

                                        </select>
                                    </td>
                                    <td><input type="text" required name="adult" class="form-control"></td>
                                    <td><input type="text" required name="children6_11" class="form-control"></td>
                                    <td><input type="text" required name="children5" class="form-control"></td>
                                    <td><input type="text" required name="children2" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="tour-details">
                            <!-- Data will be loaded here -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật giá</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".btn-create-price").click(function() {
                let tourId = $(this).data("tour_id");

                $.ajax({
                    url: "/get-tour-details", // Update this to your actual route
                    type: "GET",
                    data: {
                        tour_id: tourId
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#tour-details").html(`
                        <p><strong>Tên tour:</strong> ${response.data.name}</p>
                        <p><strong>Giá mặc định:</strong> ${response.data.price} VND</p>
                        <p><strong>Mô tả:</strong> ${response.data.description}</p>
                    `);
                            let select = $("#tour-date-select");
                            select.empty(); // Clear previous options
                            select.append('<option value="">Chọn ngày khởi hành</option>');

                            response.data.departure_dates.forEach(function(date) {
                                select.append(
                                    `<option value="${date}">${date}</option>`);
                            });
                        } else {
                            $("#tour-details").html(
                                "<p class='text-danger'>Không tìm thấy thông tin tour.</p>");
                        }
                    },
                    error: function() {
                        $("#tour-details").html(
                            "<p class='text-danger'>Lỗi khi lấy dữ liệu.</p>");
                    }
                });
            });
        });
    </script>
@endsection
@endsection
