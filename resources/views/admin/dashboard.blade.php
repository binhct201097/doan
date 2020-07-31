@extends('admin.master')
@section('title')
    <h1 class="page-header">Bảng tổng quan</h1>
@stop
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$luotbinhluan}}</div>
                        <div>Bình luận mới!</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.binhluan.list') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$khachhang}}</div>
                        <div>Khách hàng!</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.khachhang.list') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$donhang}}</div>
                        <div>Đơn hàng mới!</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.donhang.list') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-barcode fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$sanpham}}</div>
                        <div>Sản phẩm</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.sanpham.list') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->


<div class="row">
  <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Sơ đồ thống kê sản phẩm hàng tháng
            </div>
            <!-- /.panel-heading -->
            <div class="container-fluid">
                <!-- <canvas id="RadarChart" style="width:50%;"></canvas> -->
            </div>
            <!-- So do so luong san pham hang thang -->

            <?php
                //tổng sl theo từng tháng
                $sp = DB::select('select sum(lohang_so_luong_nhap) as nhap,sum(lohang_so_luong_da_ban) as ban,sum(lohang_so_luong_doi_tra) as tra,MONTH(created_at) as thang from lohang group By MONTH(created_at)');
                // dd($sp);
                $valNhap = [];
                $valBan = [];
                $valTra = [];
                for ($i= 0; $i < count($sp) ; $i++) {
                    $keys[] = 'Tháng '. $sp[$i]->thang;
                    array_push($valNhap, $sp[$i]->nhap);
                    array_push($valBan, $sp[$i]->ban);
                    array_push($valTra, $sp[$i]->tra);
                }
                // dd($keys);
                $chartjs = app()->chartjs
                     ->name('barChartTest')
                     ->type('bar')
                     ->size(['width' => 400, 'height' => 200])
                     ->labels($keys)
                     ->datasets([
                         [
                             "label" => "Nhập vào",
                             'backgroundColor' => '#337ab7',
                             'data' => $valNhap
                         ]
                         ,
                         [
                             "label" => "Bán ra",
                             'backgroundColor' => '#5cb85c',
                             'data' => $valBan
                         ]
                         ,
                         [
                            "label" => "Đổi trả",
                             'backgroundColor' => '#d9534f',
                             'data' => $valTra
                         ]
                     ])
                     ->options([]);
            ?>
            <!-- /So do so luong san pham hang thang -->

            {!! $chartjs->render() !!}
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <!-- /.panel -->
    </div>  

    @include('admin.blocks.doanhthu')
    @include('admin.blocks.comment')
</div>
<!-- /.row -->

@stop
