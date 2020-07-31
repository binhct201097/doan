@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('frontend.blocks.side-bar')
        </div>
        <div class="col-sm-9 padding-right">
            <div class="product-details">
                <!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}" alt="">
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="product-information">
                        <!--/product-information-->
                        <img src="images/product-details/new.jpg" class="newarrival" alt="">
                        <h2>{!! $sanpham->sanpham_ten !!}</h2>
                        <img src="images/product-details/rating.png" alt="">
                        <span>
                            <span>@if ($sanpham->sanpham_khuyenmai == 1)
                                <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $sanpham->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($sanpham->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $sanpham->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                <h5>{!! number_format($giakm,0,",",".") !!} vnđ <br> {!!
                                    number_format("$sanpham->gia_ban",0,",",".")
                                    !!}
                                    vnđ</h5>
                                @else
                                <h5>{!! number_format("$sanpham->gia_ban",0,",",".") !!} vnđ</h5>
                                @endif
                            </span>
                            <label>Số lượng:</label>
                            <input type="text" value="1" disable>

                            <a href="{!! url('mua-hang',[$sanpham->id,$sanpham->sanpham_url]) !!}"
                                class="btn btn-fefault cart"> <i class="fa fa-shopping-cart"></i>Add
                                to
                                cart</a>
                        </span>
                        <p><b>Tình trạng:</b> Mới</p>
                        <p><b>Chi Nhánh:</b> AHT-MOBILE Hà Nội</p>
                        <a href=""><img src="{!! asset('resources/upload/sanpham/share.png') !!}"
                                class="share img-responsive" alt=""></a>
                    </div>
                    <!--/product-information-->
                </div>
            </div>
            <!--/product-details-->

            <div class="category-tab shop-details-tab">
                <!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
                        <li class=""><a href="#tag" data-toggle="tab">Thông số kỹ thuật</a></li>
                        <li class=""><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="details">
                        {!! $sanpham->sanpham_mo_ta !!}
                    </div>

                    <div class="tab-pane fade" id="tag">
                        {!! $sanpham->thong_so_ky_thuat !!}
                    </div>

                    <div class="tab-pane fade" id="reviews">
                        <div class="col-sm-12">

                            @if (Auth::check())
                            <form action="{!! url('binh-luan') !!}" class="aa-review-form" method="POST">
                                <p class="comment-notes">
                                    Địa chỉ mail của các bạn sẽ không hiện lên và nội dung bình luận sẽ được kiểm tra
                                    trước khi phát hành <span class="required">*</span>
                                </p>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="hidden" name="txtID" value="{!! $sanpham->id !!}" />
                                <div class="form-group">
                                    <label for="message">Nội dung<span class="required">*</span></label>
                                    <textarea class="form-control" name="txtContent" rows="3" id="message"
                                        required="required"></textarea>
                                    <div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên<span class="required">*</span></label>
                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control"
                                        name="txtName" id="name" required="required" placeholder="Name" />
                                    <div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input type="email" value="{{ Auth::user()->email }}" class="form-control"
                                        name="txtEmail" id="email" placeholder="example@gmail.com"
                                        required="required" />
                                    <div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default aa-review-submit">Gửi</button>
                            </form>
                            @else
                            <form action="{!! url('binh-luan') !!}" class="aa-review-form" method="POST">
                                <p class="comment-notes">
                                    Địa chỉ mail của các bạn sẽ không hiện lên và nội dung bình luận sẽ được kiểm tra
                                    trước khi phát hành <span class="required">*</span>
                                </p>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="hidden" name="txtID" value="{!! $sanpham->id !!}" />
                                <div class="form-group">
                                    <label for="message">Nội dung<span class="required">*</span></label>
                                    <textarea class="form-control" name="txtContent" rows="3" id="message"
                                        required="required"></textarea>
                                    <div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="txtName" id="name" required="required"
                                        placeholder="Name" />
                                    <div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control" name="txtEmail" id="email"
                                        placeholder="example@gmail.com" required="required" />
                                    <div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default aa-review-submit">Gửi</button>
                            </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <!--/category-tab-->

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
                                <p style="padding-top: 15px"><a
                                        href="{!! url('san-pham',$new->sanpham_url) !!}">{!!$new->sanpham_ten !!}</a>
                                </p>
                                @if ($new->sanpham_khuyenmai == 1)
                                <?php
$tylegia = DB::select('select khuyenmai_phan_tram from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = ' . $new->id . ' and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1 ');
$giakm = ($new->gia_ban - ($tylegia[0]->khuyenmai_phan_tram * $new->gia_ban * 0.01));
$tyle = $tylegia[0]->khuyenmai_phan_tram * 0.01;
?>
                                <h5>{!! number_format($giakm,0,",",".") !!} vnđ <br> {!!
                                    number_format("$new->gia_ban",0,",",".")
                                    !!}
                                    vnđ</h5>
                                @else
                                <h5>{!! number_format("$new->gia_ban",0,",",".") !!} vnđ</h5>
                                @endif

                                <a href="{!! url('mua-hang',[$new->id,$new->sanpham_url]) !!}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to
                                    cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <p style="padding-top: 15px"><a
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
            <!--/recommended_items-->

        </div>
    </div>
</div>

@stop