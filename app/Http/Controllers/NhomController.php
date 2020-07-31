<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NhomAddRequest;
use App\Http\Requests\NhomEditRequest;
use App\Nhom;
use DB;

class NhomController extends Controller
{
    public function getList()
    {
    	$data = DB::table('nhom')->get();
    	return view('admin.nhom.danhsach', compact('data'));
    }

    public function getAdd()
    {
    	return view('admin.nhom.them');
    }

    public function postAdd(NhomAddRequest $request)
    {
    	$nhom = new Nhom;
        $nhom->nhom_ten   = $request->txtNName;
        $nhom->nhom_url   = Replace_TiengViet($request->txtNName);
        $nhom->nhom_mo_ta = $request->txtNIntro;

        $nhom->save();

        return redirect()->route('admin.nhom.list')->with(['flash_level'=>'success','flash_message'=>'Thêm nhóm sản phẩm thành công!!!']);

    }

    public function getDelete($id)
    {
        DB::table('nhom')->where('id',$id)->delete();
        return redirect()->route('admin.nhom.list')->with(['flash_level'=>'success','flash_message'=>'Xoá sản phẩm thành công!']);
    }

    public function getEdit($id)
    {
        $nhom = DB::table('nhom')->where('id',$id)->first();
        return view('admin.nhom.sua', compact('nhom'));
    }

    public function postEdit(NhomEditRequest $request, $id)
    {
        DB::table('nhom')->where('id',$id)
                         ->update([
                                'nhom_ten' => $request->txtNName,
                                'nhom_url' => Replace_TiengViet($request->txtNName),
                                'nhom_mo_ta' => $request->txtNIntro
                         ]);
        return redirect()->route('admin.nhom.list')->with(['flash_level'=>'success','flash_message'=>'Sửa sản phẩm thành công!']);
    }
}
