<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile Shop</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/backend/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">

    <!-- DataTables CSS -->
    <link
        href="{{ url('public/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}"
        rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/backend/bower_components/datatables-responsive/css/dataTables.responsive.css') }}"
        rel="stylesheet">

    <script src="{{ url('public/backend/js/ckeditor/ckeditor.js') }}"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">AHT - MOBILE SHOP</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {!! Auth::user()->name !!} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <!-- <li class="divider"></li> -->
                        <li><a href="admin/dangxuat"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>

                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{!! route('admin.index') !!}"><i class="fa fa-dashboard fa-fw"></i>Tổng quan</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-tasks"></i> Quản lý Sản phẩm<span
                                    class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.sanpham.list') !!}">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.loaisanpham.list') !!}">Hãng sản xuất</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.nhom.list') !!}">Nhóm sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.donvitinh.list') !!}">Đơn vị tính</a>
                                </li>

                                <li>
                                    <a href="{!! route('admin.nhacungcap.list') !!}">Nhà cung cấp</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.lohang.list') !!}">Nhập hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{!! route('admin.nhanvien.list') !!}"><i class="fa fa-users"></i>Nhân viên</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.khachhang.list') !!}"><i class="fa fa-users"></i>Khách
                                hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.donhang.list') !!}"><i class="fa fa-file-text"></i>Đơn đặt
                                hàng</a>
                        </li>
                        <li>
                            <a href="{!! route('admin.binhluan.list') !!}"><i class="fa fa-comments-o"></i> Bình luận
                                khách hàng</a>
                        </li>
                        <li>
                            <a href="{!! route('admin.baiviet.list') !!}"><i class="fa fa-newspaper-o"></i>Bài viết</a>
                        </li>
                        <li>
                            <a href="{!! route('admin.quangcao.list') !!}"><i class="fa fa-yelp"></i>
                                Quảng
                                cáo</a>
                        </li>
                        <li>
                            <a href="{!! route('admin.slides.list') !!}"><i class="fa fa-sliders"></i>Slider</a>
                        </li>
                        <li>
                            <a href="{!! route('admin.khuyenmai.list') !!}"><i class="fa fa-bars"></i>Khuyến mãi</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-share"></i>Liên hệ</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.thongke.list') !!}"><i class="fa fa-cubes"></i>Kho hàng</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('title')
                    </div>

                    <div class="col-lg-12">
                        @if (Session::has('flash_message'))
                        <div class="alert alert-{!! Session::get('flash_level') !!}">
                            {!! Session::get('flash_message') !!}
                        </div>
                        @endif
                        @yield('content')
                    </div>



                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Chart js -->
    <!-- <script src="{{ url('public/backend/bower_components/Chart.js-1.1.1/Chart.min.js') }}"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js">
    </script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/backend/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ url('public/backend/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script
        src="{{ url('public/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}">
    </script>

    <!-- My JavaScript -->
    <script src="{{ url('public/backend/js/myscript.js') }}"></script>


</body>

</html>