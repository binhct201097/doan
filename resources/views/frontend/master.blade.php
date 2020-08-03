<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | AHT-MOBILE</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}"> -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
    a:hover {
        color: #FE980F !important;
    }

    .add-to-cart:hover,
    .page-link:hover {
        color: #fff !important;
    }
    </style>
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> ahtmobile@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img
                                    src="{!! asset('public/images/pngtree-smartphone-shop-sale-logo-design-image_312693.jpg') !!}"
                                    alt="" /></a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="{{ url('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng <?php
$count = Cart::count();
if ($count > 0) {print_r($count);}
?></a></li>

                                @if (Auth::check())
                                <li><a href=""><i class="fa fa-lock"></i>Chào {{ Auth::user()->name }}</a></li>
                                <li><a href="{{ url('/dang-xuat') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                @else
                                <li><a href="{{ url('/dang-nhap') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <li><a href="{{ url('/dang-ky') }}"><i class="fa fa-lock"></i> Đăng ký</a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/')}}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Hãng Sản Xuất<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php $cate_product = DB::table('loaisanpham')->get();?>
                                        @foreach($cate_product as $key=>$cate)
                                        <li><a
                                                href="{!! url('loai-san-pham',$cate->loaisanpham_url) !!}">{{$cate->loaisanpham_ten}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="{!! url('san-pham') !!}">Sản Phẩm</a>
                                </li>
                                <li><a href="{!! url('bai-viet') !!}">Bài Viết</a></li>
                                <li><a href="{!! url('lien-he') !!}">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{!! route('getTimkiem') !!}" method="POST" style="margin-top: -10px">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <input type="text" name="txtSeach" id="txtseach" placeholder="Tìm kiếm...">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    @yield('content')


    <footer id="footer">
        <!--Footer-->


        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Trợ giúp</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Tình trạng đơn hàng</a></li>
                                <li><a href="#">Đổi địa điểm</a></li>
                                <li><a href="#">Chi nhánh</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <?php $loaisp = DB::table('loaisanpham')->get();?>
                            <h2>Hãng sản xuất</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <?php $cate_product = DB::table('loaisanpham')->limit(5)->get();?>
                                @foreach($cate_product as $key=>$cate)
                                <li><a
                                        href="{!! url('loai-san-pham',$cate->loaisanpham_url) !!}">{{$cate->loaisanpham_ten}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Chính sách</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Chính sách hoàn tiền</a></li>
                                <li><a href="#">Hệ thống thanh toán</a></li>
                                <li><a href="#">Hệ thống vé</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Giới thiệu</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Thông tin</a></li>
                                <li><a href="#">Nhân viên</a></li>
                                <li><a href="#">Địa điểm cửa hàng</a></li>
                                <li><a href="#">Hệ thống</a></li>
                                <li><a href="#">Nhà tài trợ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>AHT-MOBILE SHOP</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Địa chỉ Email" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Nhận những thông tin mới nhất <br />từ website của chúng tôi cập nhật cho bạn</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row" style="text-align:center">
                    Copyright © 2013 AHT-MOBILE Inc. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>

</html>