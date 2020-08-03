@extends('admin.master')

@section('content')

<form action="{!! route('admin.lohang.getAdd') !!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-green">
                <div class="panel-heading" style="height:60px;">
                    <h3>
                        <a href="{!! URL::route('admin.lohang.list') !!}" style="color:blue;"><i
                                class="fa fa-product-hunt" style="color:blue;">Lô hàng</i></a>
                        /Thêm mới
                    </h3>
                    <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{!! URL::route('admin.lohang.list') !!}"><i class="btn btn-default">Hủy</i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Mã phiếu nhập</label>
                            <input class="form-control" name="txtMaPhieuNhap" value="{!! old('txtMaPhieuNhap') !!}"
                                placeholder="Mã phiếu nhập..." />
                            <div>
                                {!! $errors->first('txtMaPhieuNhap') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Ngày nhập</label>
                            <input class="form-control" type="date" name="txtNgayNhap"
                                value="{!! old('txtNgayNhap') !!}" placeholder="Ngày nhập..." />
                            <div>
                                {!! $errors->first('txtNgayNhap') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input">Người nhập</label>
                                <div>
                                    <select id="input" name="txtNguoiNhap" class="form-control">
                                        <option value="">--Chọn người nhập--</option>
                                        <?php Select_Function($nguoinhap);?>
                                    </select>
                                </div>
                                <div>
                                    {!! $errors->first('txtNguoiNhap') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input">Nhà cung cấp</label>
                                <div>
                                    <select id="input" name="txtLHVendor" class="form-control">
                                        <option value="">--Chọn nhà cung cấp--</option>
                                        <?php Select_Function($vendor);?>
                                    </select>
                                </div>
                                <div>
                                    {!! $errors->first('txtLHVendor') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input">Sản phẩm</label>
                                <div>
                                    <select id="input" name="txtLHProduct" class="form-control">
                                        <option value="">--Chọn sản phẩm--</option>
                                        <?php Select_Function($product);?>
                                    </select>
                                </div>
                                <div>
                                    {!! $errors->first('txtLHProduct') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtLHQuant" value="{!! old('txtLHQuant') !!}"
                                    placeholder="Số lượng..." />
                                <div>
                                    {!! $errors->first('txtLHQuant') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input">Đơn vị tính</label>
                                <div>
                                    <select id="input" name="txtDonViTinh" class="form-control">
                                        <option value="">--Chọn đơn vị tính--</option>
                                        <?php Select_Function($donvitinh);?>
                                    </select>
                                </div>
                                <div>
                                    {!! $errors->first('txtDonViTinh') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Giá mua vào</label>
                                <input class="form-control" name="txtLHBuyPrice" value="{!! old('txtLHBuyPrice') !!}"
                                    placeholder="Giá mua vào..." />
                                <div>
                                    {!! $errors->first('txtLHBuyPrice') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Thành tiền</label>
                                <input class="form-control" disabled name="txtThanhtien"
                                    value="{!! old('txtThanhTien') !!}" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@stop