@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Booking</h3>

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
                        <th scope="col">Tour ID</th>
                        <th scope="col">Ngày khởi hành</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Note</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $key => $booking)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $booking->tour_id }}</td>

                            <td>{{ $booking->date_departure }}</td>
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
                                <a href="{{ route('booking.show', [$booking->id]) }}" class="btn btn-warning">Xem</a>
                                <form onsubmit="return confirm('Bạn có muốn xóa không?');"
                                    action="{{ route('booking.destroy', [$booking->id]) }}" method="POST">
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


@endsection
