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
                    @foreach($baiviet as $bv)
                    <div class="single-blog-post">
                        <h3> {!! $bv->baiviet_tieu_de !!}</h3>

                        <a href="{!! url('bai-viet',$bv->baiviet_url) !!}">
                            <img src="{!! asset('resources/upload/baiviet/'.$bv->baiviet_anh) !!}" alt="">
                        </a>
                        <a class="btn btn-primary" href="{!! url('bai-viet',$bv->baiviet_url) !!}"
                            style="margin-top: -20px;margin-bottom: 30px;">Read More</a>
                    </div>
                    @endforeach
                </div>
                <div>{{ $baiviet->links() }}</div>
            </div>
        </div>

    </div>
</div>


@stop