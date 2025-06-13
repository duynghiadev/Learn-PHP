@extends('layout')

@section('content')
    <div class="container box-list-tour top-30">
        <div class="row">
            <div class="col-md-12 col-xs-12 bx-title-lst-tour text-center">
                <div class="w100 fl title-tour1">
                    <h2 style="color: #ffc700;font-size: 30px;"><img
                            src="{{ asset('uploads/categories/' . $category->image) }}" alt="icon"
                            style="width: 80px;">{{ $category->title }}</h2>
                </div>

            </div>
            <div class="col-md-12 col-xs-12 bx-content-lst-tour">
                <div class="row">
                    @if ($tours->count() > 0)
                        @foreach ($tours as $key => $tour)
                            <div class="col-md-4 col-xs-12 lst-tour-item">
                                <div class="w100 fl bx-wap-pr-item">
                                    <div class="clearfix box-wap-imgpr">
                                        <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">
                                            <img src="{{ asset('uploads/tours/' . $tour->image) }}" class="img-default"
                                                alt="tour" style="margin-bottom: 6px;">

                                        </a>
                                    </div>
                                    <div class="clear"></div>
                                    <h4><a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">{{ $tour->title }}</a>
                                    </h4>
                                    <div class="clear"></div>
                                    <div class="group-calendar w100 fl">
                                        <div class="col-md-6 col-xs-7 date-start">
                                            <i class="fa fa-calendar"></i>
                                            {{ $tour->tour_time }}
                                        </div>
                                        <div class="col-md-6 col-xs-5 date-range">
                                            <span class="lst-icon1"><i class="fa fa-plane"></i></span><span>
                                                {{ $tour->vehicle }}</span>
                                        </div>
                                    </div>
                                    <div class="group-localtion w100 fl">
                                        <div class="col-md-6 col-xs-7 map-maker">
                                            <span class="lst-icon1"><i class="fa fa-map-marker"></i></span><span>
                                                {{ $tour->tour_from }} đến {{ $tour->tour_to }}
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-xs-5 numner-sit">
                                            <span class="lst-icon1"><i class="fa fa-users"></i></span><span> Còn
                                                chỗ:
                                                {{ $tour->quantity }}</span>
                                        </div>
                                    </div>

                                    <div class="group-book w100 fl">
                                        <span class="price-sell">{{ number_format($tour->price, 0, ',', '.') }}
                                            VNĐ
                                        </span>
                                        <a href="{{ route('chi-tiet-tour', ['du-lich-quy-nhon-phu-yen-53654.html']) }}"
                                            class="link-book btn_view_tour0">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4 col-xs-12">
                            <h4 style="align:center">Hiện tại chưa có tour danh mục này.</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
