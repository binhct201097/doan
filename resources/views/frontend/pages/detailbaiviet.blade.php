@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('frontend.blocks.side-bar')
        </div>
        <div class="col-sm-9">
            <div class="col-sm-12">
                <div class="blog-post-area">
                    <h2 class="title text-center">BÀI VIẾT MỚI NHẤT</h2>

                    <div class="single-blog-post">
                        <h3>{!! $baivietchitiet->baiviet_tieu_de !!}</h3>
                        <a href="">
                            <img src="{!! asset('resources/upload/baiviet/'.$baivietchitiet->baiviet_anh) !!}" alt="">
                        </a>
                        <p>{!! $baivietchitiet->baiviet_noi_dung !!}</p>
                        <div class="pager-area">
                            <ul class="pager pull-right">
                                <li><a href="#">Pre</a></li>
                                <li><a href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!--/blog-post-area-->

                <!--/Response-area-->
                <div class="replay-box">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Bình luận</h2>
                            <form>
                                <div class="blank-arrow">
                                    <label>Tên</label>
                                </div>
                                <span>*</span>
                                <input type="text" placeholder="write your name...">
                                <div class="blank-arrow">
                                    <label>Email</label>
                                </div>
                                <span>*</span>
                                <input type="email" placeholder="your email address...">
                                <div class="blank-arrow">
                                    <label>Địa chỉ</label>
                                </div>
                                <input type="email" placeholder="current city...">
                            </form>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-area">
                                <div class="blank-arrow">
                                    <label>Nhận xét</label>
                                </div>
                                <span>*</span>
                                <textarea name="message" rows="11"></textarea>
                                <a class="btn btn-primary" href="">Gửi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Repaly Box-->
            </div>
        </div>
    </div>
</div>



@stop