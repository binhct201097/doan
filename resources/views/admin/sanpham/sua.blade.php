@extends('admin.master')

@section('content')
<style type="text/css" media="screen">
.icon_del {
    position: relative;
    top: -200px;
    left: 150px;
}
</style>
<form action="" method="POST" enctype="multipart/form-data" name="frmEditPro">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-green">
                <div class="panel-heading" style="height:60px;">
                    <h3>
                        <a href="{!! URL::route('admin.sanpham.list') !!}" style="color:blue;"><i
                                class="fa fa-product-hunt" style="color:blue;">Sản phẩm</i></a>
                        /Cập nhật
                    </h3>
                    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{!! URL::route('admin.sanpham.list') !!}"><i class="btn btn-default">Hủy</i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-7">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="txtSPName" placeholder="Nhập tên sản phẩm..."
                                    value="{!! $sanpham->sanpham_ten !!}" />
                                <div>
                                    {!! $errors->first('txtSPName') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <div>
                                    <select name="txtSPCate" id="input" class="form-control">
                                        <option value="">--Chọn loại sản phẩm--</option>
                                        <?php Select_Function($cate, $sanpham->loaisanpham_id);?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Thông số kỹ thuật</label>
                                <textarea class="form-control" rows="3" name="txtThongSoKyThuat"
                                    placeholder="Thông số kỹ thuật...">{!! $sanpham->thong_so_ky_thuat !!}</textarea>
                                <script type="text/javascript">
                                CKEDITOR.replace('txtThongSoKyThuat');
                                </script>
                                <div>
                                    {!! $errors->first('txtThongSoKyThuat') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="3" name="txtSPIntro"
                                    placeholder="Mô tả...">{!! $sanpham->sanpham_mo_ta !!}</textarea>
                                <script type="text/javascript">
                                CKEDITOR.replace('txtSPIntro');
                                </script>
                                <div>
                                    {!! $errors->first('txtSPIntro') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Giá bán</label>
                                <input class="form-control" name="txtGiaBan" placeholder="Giá bán..."
                                    value="{!! $sanpham->gia_ban !!}" />
                                <div>
                                    {!! $errors->first('txtGiaBan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Hình ảnh </label>
                                <br>
                                <img src="{!! asset('resources/upload/sanpham/'.$sanpham->sanpham_anh) !!}"
                                    class="img-responsive img-rounded" alt="Image" style="width: 150px; height: 200px;">
                                <input type="hidden" name="fImageCurrent" value="{!! $sanpham->sanpham_anh !!}">

                                <br>
                                <input type="file" name="fImage">
                            </div>
                        </div><br><br><br><br>
                        <div class="col-lg-12">
                            <label>Hình ảnh chi tiết</label><br>
                            @foreach ($images as $key => $img)
                            <div class="form-group" id="{!! $key !!}">
                                <br>
                                <img src="{!! asset('/resources/upload/chitietsanpham/'.$img->hinhsanpham_ten) !!}"
                                    class="img-responsive img-rounded" alt="Image" style="width: 150px; height: 200px;"
                                    class="img_detail" idHinh="{!! $img->id !!}" id="{!! $key !!}">
                                <a id="del_img_demo" href="javascript:void(0)"
                                    class="btn btn-danger btn-circle icon_del"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-primary" id="addImage">Add Image</button>
                            <div id="insert"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop