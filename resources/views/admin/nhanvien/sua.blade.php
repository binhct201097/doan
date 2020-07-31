@extends('admin.master')
@section('title')
    <h1 class="page-header">Sửa nhân viên</h1>
@stop
@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="col-lg-7" style="padding-bottom:120px">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtNVName" value="{!! $nhanvien->nhanvien_ten !!}" placeholder="Tên..." />
                <div>
                    {!! $errors->first('txtNVName') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Số CMND</label>
                <input class="form-control" name="txtNVID" value="{!! $nhanvien->nhanvien_cmnd !!}" placeholder="Số cmnd..." />
                <div>
                    {!! $errors->first('txtNVID') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="txtNVPhone" value="{!! $nhanvien->nhanvien_sdt !!}" placeholder="Số điện thoại..." />
                <div>
                    {!! $errors->first('txtNVPhone') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Ngày vào làm</label>
                <input class="form-control" type="date" name="txtNVDate" value="{!! $nhanvien->nhanvien_ngay_vao_lam!!}"/>
                <div>
                    {!! $errors->first('txtNVDate') !!}
                </div>  
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea class="form-control" rows="3" name="txtNVAddress" placeholder="Địa chỉ...">{!! $nhanvien->nhanvien_dia_chi !!}</textarea>
                <div>
                        {!! $errors->first('txtNVAddress') !!}
                    </div> 
            </div>
        </div>
        
        </div>
        <div class="col-lg-5" style="padding-bottom:120px">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Tài khoản</label>
                    <input class="form-control" name="txtUsername" value="{!! $user->name !!}" placeholder="Tài khoản..." />
                    <div>
                        
                        {!! $errors->first('txtUsername') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="txtEmail" value="{!! $user->email !!}" placeholder="abc@gmail.com,..." />
                    <div>
                        {!! $errors->first('txtEmail') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input class="form-control" type="password" name="txtPass"  placeholder="Mật khẩu..." />
                    <div>
                        {!! $errors->first('txtPass') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input class="form-control" type="password" name="txtRePass"  placeholder="Nhập lại mật khẩu..." />
                    <div>
                        {!! $errors->first('txtRePass') !!}
                    </div>  
                    
                </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
                <label for="input" >Loại người dùng</label>
                <div>
                    <select id="input" name="txtRole"  class="form-control">
                            <option value="">--Chọn loại người dùng--</option>
                            <?php Select_Function($loainguoidung); ?>
                    </select>
                </div>
                <div>
                    {!! $errors->first('txtRole') !!}
                </div> 
            </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-default">Sửa</button>
            <a href="{!! URL::route('admin.nhanvien.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
        </div>
    </form>

@stop