@extends('admin.master')
@section('title')
<h3 class="page-header">Kho hàng</h3>
@stop
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-arrow-circle-o-down fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->nhap !!}</div>
                        <div>Sản phẩm nhập vào</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.thongke.nhapvao') !!}">
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
                        <i class="fa fa-arrow-circle-o-up fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->ban !!}</div>
                        <div>Sản phẩm đã bán</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.thongke.banra') !!}">
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
                        <i class="fa fa-th-large fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->ton !!}</div>
                        <div>Sản phẩm hiện có</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.thongke.hienco') !!}">
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
                        <i class="fa fa-undo fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->tra !!}</div>
                        <div>Sản phẩm đổi trả</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.thongke.doitra') !!}">
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

    <div class="col-lg-6">

        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Bán chạy nhất</i></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($bannhieu as $item)
                        <tr>
                            <?php $sp = DB::table('sanpham')->where('id', $item->sanpham_id)->first();?>
                            <td>{!! $item->sanpham_id !!}</td>
                            <td>{!! $sp->sanpham_ten !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                                <a href="{!! URL::route('admin.lohang.getNhaphang', [$item->sanpham_id] ) !!}"
                                    type="button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                    data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a href="{!! URL::route('admin.thongke.banchay') !!}" class="btn btn-default" type="button">Xem
                            chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-6-->
    <div class="col-lg-6">

        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Tồn nhiều nhất</i></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tonnhieu as $item)
                        <tr>
                            <?php $sp = DB::table('sanpham')->where('id', $item->sanpham_id)->first();?>
                            <td>{!! $item->sanpham_id !!}</td>
                            <td>{!! $sp->sanpham_ten !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                                <a href="{!! URL::route('admin.lohang.getNhaphang', [$item->sanpham_id] ) !!}"
                                    type="button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                    data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a href="{!! URL::route('admin.thongke.tonnhieu') !!}" class="btn btn-default" type="button">Xem
                            chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
</div>

@stop