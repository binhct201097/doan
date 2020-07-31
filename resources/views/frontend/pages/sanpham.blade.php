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
                                <p style="padding-top: 15px"><a
                                        href="{!! url('san-pham',$item->sanpham_url) !!}">{!!$item->sanpham_ten !!}</a>
                                </p>
                                @if ($item->sanpham_khuyenmai == 1)
                                <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $item->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($item->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $item->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                <h5>{!! number_format($giakm,0,",",".") !!} vnđ <br> {!!
                                    number_format("$item->gia_ban",0,",",".")
                                    !!}
                                    vnđ</h5>
                                @else
                                <h5>{!! number_format("$item->gia_ban",0,",",".") !!} vnđ</h5>
                                @endif

                                <a href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to
                                    cart</a>
                            </div>
                            <div class="product-overlay">
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
        </div>
    </div>
</div>
@endsection