@extends('admin.layouts.master')

@section('title')
    Thêm vận chuyển
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
        <h1 class="mt-4">Thêm vận chuyển</h1>
        <ol class="breadcrumb mb-4" style="margin-bottom: 50px!important;">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Vận chuyển</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form>
                    @csrf 
             
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn thành phố</label>
                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                    
                            <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach($city as $key => $ci)
                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                        @endforeach
                            
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                            <option value="">--Chọn quận huyện--</option>
                           
                    </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Chọn xã phường</label>
                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                            <option value="">--Chọn xã phường--</option>   
                    </select>
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Phí">
                </div>
               
                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                </form>
                <div id="load_delivery">
                                
                </div>
                   
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
    <script>
         fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{route('admin.transport.select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                $('#load_delivery').html(data);
                }
            });
        }
         $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{route('admin.transport.select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
        $(document).on('blur','.fee_feeship_edit',function(){

        var feeship_id = $(this).data('feeship_id');
        var fee_value = $(this).text();
        var _token = $('input[name="_token"]').val();
        // alert(feeship_id);
        // alert(fee_value);
        $.ajax({
            url : '{{route('admin.transport.update-delivery')}}',
            method: 'POST',
            data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
            success:function(data){
            fetch_delivery();
            }
        });

        });
        $('.add_delivery').click(function(){

            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            // alert(city);
            // alert(province);
            // alert(wards);
            // alert(fee_ship);
            $.ajax({
                url : '{{route('admin.transport.insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                    $('.city').val('');
                    $('.province').val('');
                    $('.wards').val('');
                    $('.fee_ship').val('');
                    fetch_delivery();

                }
            });


            });
    </script>
@endsection
