<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Khachhang;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachhangController extends Controller
{

    public function getList()
    {
        $data = DB::table('khachhang')->get();
        return view('admin.khachhang.danhsach', compact('data'));
    }

    public function getAdd()
    {
        # code...
    }

    public function postAdd()
    {
        # code...
    }

    public function getDelete($id)
    {
        $id_user = DB::table('khachhang')
            ->select('user_id')
            ->where('id', $id)
            ->first();
        DB::table('khachhang')->where('id', $id)->delete();
        DB::table('users')->where('id', $id_user->user_id)->delete();
        return redirect()->route('admin.khachhang.list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa khách hàng thành công!!!']);
    }

    public function getEdit()
    {
        # code...
    }

    public function postEdit()
    {
        # code...
    }

    public function getHistory($id)
    {
        $khachhang = DB::table('khachhang')->where('id', $id)->first();
        $donhang = DB::table('donhang')->where('khachhang_id', $id)->get();
        return view('admin.khachhang.lichsu', compact('khachhang', 'donhang'));
    }

    public function getDangky()
    {
        return view('auth.register');
    }

    public function postDangky(RegisterRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->loainguoidung_id = 2;
        $user->remember_token = $request->_token;
        $user->save();

        $id = DB::table('users')->select('id')->where('email', $request->email)->first();
        $userid = $id->id;

        $khachhang = new Khachhang;
        $khachhang->khachhang_ten = $request->txtname;
        $khachhang->khachhang_sdt = $request->txtphone;
        $khachhang->khachhang_email = $request->email;
        $khachhang->khachhang_dia_chi = $request->txtadr;
        $khachhang->user_id = $userid;
        $khachhang->save();
        echo "<script>
          alert('Bạn đã đăng ký tài khoản thành công!');
          window.location = '" . url('/') . "';</script>";
    }

    public function getDangnhap()
    {
        $cate_product = DB::table('loaisanpham')->get();
        $product = DB::table('sanpham')->get();
        return view('auth.login', compact('cate_product', 'product'));
    }

    public function postDangnhap(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => "Bạn chưa nhập email",
            'password.required' => 'Bạn chưa nhập password',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('/dang-nhap')->with('thongbao', 'Sai thông tin tài khoản !');
        }
    }

    public function getDangxuat()
    {
        Auth::logout();
        return redirect('/dang-nhap');
    }
}