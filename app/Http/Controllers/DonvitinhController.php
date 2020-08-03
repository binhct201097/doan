<?php

namespace App\Http\Controllers;

use App\Donvitinh;
use App\Http\Requests\DonvitinhAddRequest;
use App\Http\Requests\DonvitinhEditRequest;
use DB;

class DonvitinhController extends Controller
{
    public function getList()
    {
        $data = DB::table('donvitinh')->get();
        return view('admin.donvitinh.danhsach', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.donvitinh.them');
    }

    public function postAdd(DonvitinhAddRequest $request)
    {
        $dvt = new Donvitinh;

        $dvt->donvitinh_ten = $request->txtDVTName;
        $dvt->donvitinh_mo_ta = $request->txtDVTIntro;
        $dvt->soluong = $request->txtSoLuong;

        $dvt->save();
        return redirect()->route('admin.donvitinh.list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm đơn vị thành công!']);
    }

    public function getDelete($id)
    {
        DB::table('donvitinh')->where('id', $id)->delete();
        return redirect()->route('admin.donvitinh.list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa đơn vị thành công!']);
    }

    public function getEdit($id)
    {
        $dvt = DB::table('donvitinh')->where('id', $id)->first();
        return view('admin.donvitinh.sua', compact('dvt'));
    }

    public function postEdit(DonvitinhEditRequest $request, $id)
    {
        DB::table('donvitinh')->where('id', $id)
            ->update([
                'donvitinh_ten' => $request->txtDVTName,
                'donvitinh_mo_ta' => $request->txtDVTIntro,
                'soluong' => $request->txtSoLuong,
            ]);
        return redirect()->route('admin.donvitinh.list')->with(['flash_level' => 'success', 'flash_message' => 'Sửa đơn vị thành công!']);
    }
}