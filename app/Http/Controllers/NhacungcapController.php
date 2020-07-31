<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\NhacungcapAddRequest;
use App\Http\Requests\NhacungcapEditRequest;
use App\Nhacungcap;

use DB;

class NhacungcapController extends Controller
{
    public function getList()
    {
    	$data = DB::table('nhacungcap')->get();
    	return view('admin.nhacungcap.danhsach', compact('data'));
    }

    public function getAdd()
    {
    	return view('admin.nhacungcap.them');
    }

    public function postAdd(NhacungcapAddRequest $request)
    {
    	$nhacungcap = new Nhacungcap;

    	$nhacungcap->nhacungcap_ten = $request->txtNCCName;
    	$nhacungcap->nhacungcap_dia_chi = $request->txtNCCAdress;
    	$nhacungcap->nhacungcap_sdt = $request->txtNCCPhone;

    	$nhacungcap->save();

    	return redirect()->route('admin.nhacungcap.list')->with(['flash_level'=>'success', 'flash_message'=>'Thêm thành công nhà cung cấp!']);
    }

    public function getEdit($id)
    {
    	$data = DB::table('nhacungcap')->where('id',$id)->first();
    	return view('admin.nhacungcap.sua', compact('data'));
    }

    public function postEdit(NhacungcapEditRequest $request,$id)
    {
    	DB::table('nhacungcap')->where('id',$id)
    						   ->update([
    						   	'nhacungcap_ten' => $request->txtNCCName,
    						   	'nhacungcap_dia_chi' => $request->txtNCCAdress,
    						   	'nhacungcap_sdt' => $request->txtNCCPhone
    						   ]);
    	return redirect()->route('admin.nhacungcap.list')->with(['flash_level'=>'success', 'flash_message'=>'Sửa thành công nhà cung cấp!']);
    }

    public function getDelete($id)
    {
    	DB::table('nhacungcap')->where('id',$id)->delete();
    	return redirect()->route('admin.nhacungcap.list')->with(['flash_level'=>'success', 'flash_message'=>'Xóa thành công nhà cung cấp!']);
    }
}
