<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Hinhsanpham;
use App\Http\Requests\SanphamAddRequest;
use App\Http\Requests\SanphamEditRequest;
use App\Sanpham;
use DB;
use File;
use Input;
use Request;

class SanphamController extends Controller
{
    public function getList()
    {
        $data = DB::table('sanpham')->orderBy('id', 'DESC')->get();
        return view('admin.sanpham.danhsach', compact('data'));
    }

    public function getAdd()
    {
        $cates = DB::table('loaisanpham')->get();
        foreach ($cates as $key => $value) {
            $cate[] = ['id' => $value->id, 'name' => $value->loaisanpham_ten];
        }

        return view('admin.sanpham.them', compact('cate'));
    }

    public function postAdd(SanphamAddRequest $request)
    {
        $sanpham = new Sanpham;

        $filename = $request->file('txtSPImage')->getClientOriginalName();
        $request->file('txtSPImage')->move('resources/upload/sanpham/', $filename);

        $sanpham->sanpham_ten = $request->txtSPName;
        $sanpham->sanpham_url = Replace_TiengViet($request->txtSPName);
        $sanpham->sanpham_anh = $filename;
        $sanpham->sanpham_mo_ta = $request->txtSPIntro;
        $sanpham->loaisanpham_id = $request->txtSPCate;
        $sanpham->thong_so_ky_thuat = $request->txtThongSoKyThuat;
        $sanpham->gia_ban = $request->txtGiaBan;
        $sanpham->sanpham_khuyenmai = 0;

        $sanpham->save();

        $files = [];
        if ($request->file('txtSPImage1')) {
            $files[] = $request->file('txtSPImage1');
        }
        if ($request->file('txtSPImage2')) {
            $files[] = $request->file('txtSPImage2');
        }

        $names = [];

        foreach ($files as $file) {
            if (!empty($file)) {
                $filename = $file->getClientOriginalName();
                $file->move(
                    base_path() . '/resources/upload/chitietsanpham/', $filename
                );

                $hinh = new Hinhsanpham;
                $hinh->hinhsanpham_ten = $filename;
                $hinh->sanpham_id = $sanpham->id;
                $hinh->save();
            }
        }

        return redirect()->route('admin.sanpham.list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm sản phẩm thành công!']);
    }

    public function getDelete($id)
    {
        $sanpham = DB::table('sanpham')->where('id', $id)->first();
        $img = 'resources/upload/sanpham/' . $sanpham->sanpham_anh;
        File::delete($img);

        DB::table('sanpham')->where('id', $id)->delete();
        return redirect()->route('admin.sanpham.list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa loại sản phẩm thành công!!!']);
    }

    public function getEdit($id)
    {
        $sanpham = DB::table('sanpham')->where('id', $id)->first();

        $cates = DB::table('loaisanpham')->get();
        foreach ($cates as $key => $val) {
            $cate[] = ['id' => $val->id, 'name' => $val->loaisanpham_ten];
        }

        $images = DB::table('hinhsanpham')->where('sanpham_id', $id)->get();

        return view('admin.sanpham.sua', compact('sanpham', 'id', 'cate', 'images'));
    }

    public function postEdit(SanphamEditRequest $request, $id)
    {
        $sanpham = Sanpham::find($id);
        $sanpham->sanpham_ten = Request::input('txtSPName');
        $sanpham->sanpham_url = Replace_TiengViet(Request::input('txtSPName'));
        $sanpham->sanpham_mo_ta = Request::input('txtSPIntro');
        $sanpham->loaisanpham_id = Request::input('txtSPCate');
        $sanpham->thong_so_ky_thuat = Request::input('txtThongSoKyThuat');
        $sanpham->gia_ban = Request::input('txtGiaBan');

        $img_current = 'resources/upload/sanpham/' . Request::input('fImageCurrent');
        if (!empty(Request::file('fImage'))) {
            $filename = Request::file('fImage')->getClientOriginalName();
            $sanpham->sanpham_anh = $filename;
            Request::file('fImage')->move(base_path() . '/resources/upload/sanpham/', $filename);
            File::delete($img_current);
        }

        if (!empty(Request::file('fEditImage'))) {
            foreach (Request::file('fEditImage') as $file) {
                $detail_img = new Hinhsanpham();
                if (isset($file)) {
                    $detail_img->hinhsanpham_ten = $file->getClientOriginalName();
                    $detail_img->sanpham_id = $id;
                    $file->move('resources/upload/chitietsanpham/', $file->getClientOriginalName());
                    $detail_img->save();
                }
            }
        }

        $sanpham->save();

        return redirect()->route('admin.sanpham.list')->with(['flash_level' => 'success', 'flash_message' => 'Sửa sản phẩm thành công!!!']);
    }

    public function delImage($id)
    {
        if (Request::ajax()) {
            $idHinh = (int) Request::get('idHinh');
            $image_detail = Hinhsanpham::find($idHinh);
            if (!empty($image_detail)) {
                $img = 'resources/upload/chitietsanpham/' . $image_detail->hinhsanpham_ten;
                //print_r($img);
                //if(File::isFile($img)) {
                File::delete($img);
                //}
                $image_detail->delete();
            }
            return "Oke";
        }
    }
}