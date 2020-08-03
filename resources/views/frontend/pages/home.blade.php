@extends('frontend.master')
@section('content')
@include('frontend.blocks.slider')

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('frontend.blocks.side-bar')
        </div>

        <div class="col-sm-9">
            <div class="features_items">
                <!--features_items-->
                <h2 class="title text-center">SẢN PHẨM</h2>
                @foreach ($sanpham as $item)
                <?php
$sanphamkhuyenmai = DB::select('select* from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1');
?>
                <div class="col-sm-3">
                    <div class="product-image-wrapper" style="height:310px">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{!! asset('resources/upload/sanpham/'.$item->sanpham_anh) !!}" alt="" />
                                <p style="padding-top: 15px"><a style="color:black; font-weight: 500"
                                        href="{!! url('san-pham',$item->sanpham_url) !!}">{!!$item->sanpham_ten !!}</a>
                                </p>
                                @if ($item->sanpham_khuyenmai == 1)
                                <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $item->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($item->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $item->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                <h5>{!! number_format($giakm,0,",",".") !!} vnđ <br>
                                    <del style="color:grey">{!!
                                        number_format("$item->gia_ban",0,",",".")
                                        !!}
                                        vnđ</del></h5>
                                @else
                                <h5>{!! number_format("$item->gia_ban",0,",",".") !!} vnđ</h5>
                                @endif

                                <a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to
                                    cart</a>
                            </div>
                            <div>
                                <div class="overlay-content">
                                    <p><a href="{!! url('san-pham',$item->sanpham_url) !!}">{!!$item->sanpham_ten
                                            !!}</a>
                                    </p>
                                    @if ($item->sanpham_khuyenmai == 1)
                                    <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $item->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($item->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $item->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                    <h2>{!! number_format($giakm,0,",",".") !!} vnđ {!!
                                        number_format("$item->gia_ban",0,",",".")
                                        !!} vnđ</h2>
                                    @else
                                    <h2>{!! number_format("$item->gia_ban",0,",",".") !!} vnđ</h2>
                                    @endif

                                    <a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                        to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div>{{ $sanpham->links() }}</div>
            </div>


            <div class="features_items">
                <!--features_items-->
                <h2 class="title text-center">SẢN PHẨM MỚI</h2>
                @foreach ($product_new as $new)
                <?php
$sanphamkhuyenmai = DB::select('select* from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1');
?>
                <div class="col-sm-3">
                    <div class="product-image-wrapper" style="height:310px">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{!! asset('resources/upload/sanpham/'.$new->sanpham_anh) !!}" alt="" />
                                <p style="padding-top: 15px"><a style="color:black; font-weight: 500"
                                        href="{!! url('san-pham',$new->sanpham_url) !!}">{!!$new->sanpham_ten !!}</a>
                                </p>
                                @if ($new->sanpham_khuyenmai == 1)
                                <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $new->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($new->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $new->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                <h5>{!! number_format($giakm,0,",",".") !!} vnđ <br> <del style="color:grey">{!!
                                        number_format("$new->gia_ban",0,",",".")
                                        !!}
                                        vnđ</del></h5>
                                @else
                                <h5>{!! number_format("$new->gia_ban",0,",",".") !!} vnđ</h5>
                                @endif

                                <a href="{!! url('mua-hang',[$new->id,$new->sanpham_url]) !!}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to
                                    cart</a>
                            </div>
                            <div>
                                <div class="overlay-content">
                                    <p style="padding-top: 15px"><a style="color:black; font-weight: 500"
                                            href="{!! url('san-pham',$new->sanpham_url) !!}">{!!$new->sanpham_ten
                                            !!}</a>
                                    </p>
                                    @if ($new->sanpham_khuyenmai == 1)
                                    <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $new->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($new->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $new->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                    <h2>{!! number_format($giakm,0,",",".") !!} vnđ {!!
                                        number_format("$new->gia_ban",0,",",".")
                                        !!} vnđ</h2>
                                    @else
                                    <h2>{!! number_format("$new->gia_ban",0,",",".") !!} vnđ</h2>
                                    @endif
                                    <p>{{$new->sanpham_ten}}</p>
                                    <a href="{!! url('mua-hang',[$new->id,$new->sanpham_url]) !!}"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                        to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div>{{ $product_new->links() }}</div>
            </div>

            <div class="recommended_items">
                <!--recommended_items-->
                <h2 class="title text-center">BÀI VIẾT</h2>
                @foreach($baiviet as $baiviets)
                <div class="col-sm-4 col-lg-4">
                    <div class="product-image-wrapper" style="height:250px;">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{!! asset('resources/upload/baiviet/'.$baiviets->baiviet_anh) !!}" alt="" />
                                <a href="{!! url('bai-viet',$baiviets->baiviet_url) !!}"
                                    style="margin-top: 20px; display:block; padding-bottom:10px">{{$baiviets->baiviet_tieu_de}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <!--/recommended_items-->
    </div>
</div>
</div>


@endsection