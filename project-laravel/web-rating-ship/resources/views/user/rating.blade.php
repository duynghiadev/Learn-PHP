@extends('user.layouts.master')

@section('title')
    Đánh giá sao
@endsection

@section('content')
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">Đánh giá</h2>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- map start -->

    <!-- map end -->
    <!-- contact-section satrt -->
    <section class="contact-section pt-80 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 mb-30">
                    <!--  contact form content -->
                    <div class="contact-form-content">
                        <h4 class="text-bold" style="font-weight: bold; margin-bottom: 20px">Đánh giá của bạn</h4>
                        <div class="contact-form">
                            <form id="contact-form" action="" method="POST">
                                @csrf
                                <div class="ratting-form">
                                    <div id="rating">
                                        <form action="" method="POST">
                                            <h3>Đánh giá</h3>
                                            <input type="radio" name="rate" value="5" checked> 5
                                            <input type="radio" name="rate" value="4"> 4
                                            <input type="radio" name="rate" value="3"> 3
                                            <input type="radio" name="rate" value="2"> 2
                                            <input type="radio" name="rate" value="1"> 1<br />
                                            <input type="submit" name="rate_submit" value="Rate" id="submit-button">
                                        </form>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" value="submit" id="submit" class="btn btn-dark btn--lg" name="submit">
                                        Gửi
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p class="form-message mt-10"></p>
                    </div>
                    <!-- End of contact -->
                </div>
            </div>
        </div>
    </section>
@endsection
