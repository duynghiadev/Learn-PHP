@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tour đã đặt</h3>

                </div>

                <div class="table table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Giá tour</th>
                                <th scope="col">Phương tiện</th>
                                <th scope="col">Mã tour</th>
                                <th scope="col">Image</th>
                                <th scope="col">Ngày khởi hành</th>
                                <th scope="col">Nơi đi</th>
                                <th scope="col">Nơi đến</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>


                                <td>{{ $tour->title }}</td>

                                <td>{{ number_format($tour->price, 0, ',', '.') }}vnd</td>

                                <td>{{ $tour->vehicle }}</td>
                                <td>{{ $tour->tour_code }}</td>
                                <td><img height="120" width="120" src="{{ asset('uploads/tours/' . $tour->image) }}">
                                </td>


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
                                <td>{{ $tour->tour_from }}</td>
                                <td>{{ $tour->tour_to }}</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h4>Thông tin đặt tour</h4>
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th scope="col">Tour ID</th>
                        <th scope="col">Ngày khởi hành</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Note</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Tình trạng</th>

                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{ $booking->tour_id }}</td>

                        <td> <span class="badge rounded-pill bg-primary">{{ $booking->date_departure }}</span></td>
                        <td>{{ $booking->fullname }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->note }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->updated_at }}</td>
                        <td>
                            @if ($booking->status == 0)
                                <span class="text text-warning">Đang chờ</span>
                            @else
                                <span class="text text-success">Đã xử lý</span>
                            @endif
                        </td>
                        <td>
                            <select class="form-control" name="status">
                                <option class="0">Chưa xử lý</option>
                                <option class="1">Đã xử lý</option>
                            </select>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h4>Số lượng người đi tour</h4>
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th scope="col">Người lớn</th>
                        <th scope="col">Trẻ em 6-11</th>
                        <th scope="col">Trẻ em 2-5</th>
                        <th scope="col">Trẻ em < 2</th>


                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{ $booking->adult }}</td>

                        <td>{{ $booking->children6_11 }}</td>
                        <td>{{ $booking->children2_5 }}</td>
                        <td>{{ $booking->children2 }}</td>


                    </tr>


                </tbody>
            </table>
        </div>
    </div>

@endsection
