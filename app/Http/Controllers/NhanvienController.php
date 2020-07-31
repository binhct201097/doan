<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\NhanvienAddRequest;
use App\Http\Requests\NhanvienEditRequest;
use App\Nhanvien;
use App\User;
use DB;
use Hash;

class NhanvienController extends Controller
{
    public function getList()
    {
    	$data = DB::table('nhanvien')->join('users','users.id','=','nhanvien.user_id')->get();
    	return view('admin.nhanvien.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	$data = DB::table('loainguoidung')->get();
        foreach ($data as $key => $val) {
            $loainguoidung[] = ['id' => $val->id, 'name'=> $val->loainguoidung_ten];
        }
        return view('admin.nhanvien.them',compact('loainguoidung'));
    }

    public function postAdd(NhanvienAddRequest $request)
    {
        $user = new User;
        $user->name = $request->txtUsername;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->loainguoidung_id = $request->txtRole;
        $user->remember_token = $request->_token;
        $user->save();

        $id = DB::table('users')->select('id')->where('email',$request->txtEmail)->first();
        $userid = $id->id;

        $nhanvien = new Nhanvien;
        $nhanvien->nhanvien_ten = $request->txtNVName;
        $nhanvien->nhanvien_cmnd = $request->txtNVID;
        $nhanvien->nhanvien_sdt = $request->txtNVPhone;
        $nhanvien->nhanvien_ngay_vao_lam = $request->txtNVDate;
        $nhanvien->nhanvien_dia_chi = $request->txtNVAddress;
        $nhanvien->user_id = $userid;
        $nhanvien->save();
        return redirect()->route('admin.nhanvien.list')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);

    }

    public function getEdit($id)
    {
        $user = DB::table('users')->where('id',$id)->first();
        $nhanvien = DB::table('nhanvien')->where('user_id',$id)->first();
        $data = DB::table('loainguoidung')->get();
        foreach ($data as $key => $val) {
            $loainguoidung[] = ['id' => $val->id, 'name'=> $val->loainguoidung_ten];
        }
        return view('admin.nhanvien.sua',compact('loainguoidung','nhanvien', 'user'));
    }

    public function postEdit(NhanvienEditRequest $request,$id)
    {       
        DB::table('users')->where('id',$id)
                           ->update([
                            'name' => $request->txtUsername,
                            'email' => $request->txtEmail,
                            'password' => Hash::make($request->txtPass),
                            'loainguoidung_id' => $request->txtRole
                           ]);       
        DB::table('nhanvien')->where('user_id',$id)
                           ->update([
                            'nhanvien_ten' => $request->txtNVName,
                            'nhanvien_cmnd' => $request->txtNVID,
                            'nhanvien_sdt' => $request->txtNVPhone,
                            'nhanvien_ngay_vao_lam' => $request->txtNVDate,
                            'nhanvien_dia_chi' => $request->txtNVAddress
                           ]);
        return redirect()->route('admin.nhanvien.list')->with(['flash_level'=>'success','flash_message'=>'Cập nhật nhân viên thành công!!!']);
    }
     public function getDelete($id)
     {
        
        DB::table('nhanvien')->where('user_id',$id)->delete();
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('admin.nhanvien.list')->with(['flash_level'=>'success','flash_message'=>'Xóa nhân viên thành công!!!']);
     }
}
