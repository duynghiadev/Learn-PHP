@extends('admin.layouts.master')

@section('title')
    Danh sách bình luận
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
        #customers > tbody > tr > td:nth-child(3),
        #customers > tbody > tr > td:nth-child(4),
        #customers > tbody > tr > td:nth-child(6),
        #customers > tbody > tr > td:nth-child(7) {
            text-align: center !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách bình luận</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Bình luận</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped" id="comment">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên người comment</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Sản phẩm</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($comment as $key => $comm)
                      <tr>
                        <td>{{$key}}</td>
                        <td>{{$comm->name}}</td>
                        <td>{{$comm->content}}</td>
                        <td>{{$comm->email}}</td>
                        <td><a href="{{route('home.show',[$comm->product->id])}}" target="_blank">{{$comm->product->name}}</a></td>
                      </tr>

                     @endforeach
                    </tbody>
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
        $(document).ready( function () {
            $('#comment').DataTable();
        } );    
    </script>    
@endsection
