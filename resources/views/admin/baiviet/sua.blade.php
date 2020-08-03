@extends('admin.master')

@section('content')
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-green">
                <div class="panel-heading" style="height:60px;">
                    <h3>
                        <a href="{!! URL::route('admin.baiviet.list') !!}" style="color:blue;"><i
                                class="fa fa-product-hunt" style="color:blue;">Bài viết</i></a>
                        /Cập nhật
                    </h3>
                    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{!! URL::route('admin.baiviet.list') !!}"><i class="btn btn-default">Hủy</i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Cập nhật bài viết</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input class="form-control" name="txtBVTittle"
                                            value="{!! $baiviet->baiviet_tieu_de !!}" />
                                        <div>
                                            {!! $errors->first('txtBVTittle') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Tóm tắt</label>
                                        <textarea class="form-control" rows="2" name="txtBVResum"
                                            placeholder="Mô tả...">{!! $baiviet->baiviet_tom_tat !!}</textarea>
                                        <script type="text/javascript">
                                        CKEDITOR.replace('txtBVResum');
                                        </script>
                                        <div>
                                            {!! $errors->first('txtBVResum') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control" rows="3" name="txtBVContent"
                                            placeholder="Mô tả...">{!! $baiviet->baiviet_noi_dung !!}</textarea>
                                        <script type="text/javascript">
                                        CKEDITOR.replace('txtBVContent');
                                        </script>
                                        <div>
                                            {!! $errors->first('txtBVContent') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>
                                        <br>
                                        <img src="{!! asset('resources/upload/baiviet/'.$baiviet->baiviet_anh) !!}"
                                            class="img-responsive img-rounded" alt="Image"
                                            style="width: 150px; height: 200px;">
                                        <input type="hidden" name="fImageCurrent" value="{!! $baiviet->baiviet_anh !!}">
                                        <br>
                                        <input type="file" name="fImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop