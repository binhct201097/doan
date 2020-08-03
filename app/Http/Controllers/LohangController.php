<?php

namespace App\Http\Controllers;

use App\Http\Requests\LohangAddRequest;
use App\Http\Requests\LohangEditRequest;
use App\Lohang;
use DB;

class LohangController extends Controller
{
    public function getList()
    {
        $data = DB::table('lohang')->orderBy('id', 'DESC')->get();
        return view('admin.lohang.danhsach', compact("data"));
    }

    public function getAdd()
    {
        $products = DB::table('sanpham')->get();
        foreach ($products as $key => $value) {
            $product[] = ['id' => $value->id, 'name' => $value->sanpham_ten];
        }

        $vendors = DB::table('nhacungcap')->get();
        foreach ($vendors as $key => $value) {
            $vendor[] = ['id' => $value->id, 'name' => $value->nhacungcap_ten];
        }

        $donvitinhs = DB::table('donvitinh')->get();
        foreach ($donvitinhs as $key => $value) {
            $donvitinh[] = ['id' => $value->id, 'name' => $value->donvitinh_ten, 'soluong' => $value->soluong];
        }

        $nguoinhaps = DB::table('nhanvien')->get();
        foreach ($nguoinhaps as $key => $value) {
            $nguoinhap[] = ['id' => $value->id, 'name' => $value->nhanvien_ten];
        }

        return view('admin.lohang.them', compact('product', 'vendor', 'donvitinh', 'nguoinhap'));
    }

    public function postAdd(LohangAddRequest $request)
    {
        $donvi = 0;
        $donvitinhs = DB::table('donvitinh')->get();
        foreach ($donvitinhs as $key => $value) {
            if ($value->id == $request->txtDonViTinh) {
                echo $value->soluong;
                $donvi = $value->soluong;
            }
        }

        $lohang = new Lohang;

        $lohang->lohang_gia_mua_vao = $request->txtLHBuyPrice;
        $lohang->lohang_so_luong_nhap = $request->txtLHQuant * $donvi;
        $lohang->lohang_so_luong_da_ban = 0;
        $lohang->lohang_so_luong_doi_tra = 0;
        $lohang->lohang_so_luong_hien_tai = $request->txtLHQuant * $donvi;
        $lohang->nhacungcap_id = $request->txtLHVendor;
        $lohang->sanpham_id = $request->txtLHProduct;

        $lohang->maphieunhap = $request->txtMaPhieuNhap;
        $lohang->ngay_nhap = $request->txtNgayNhap;
        $lohang->id_nguoinhap = $request->txtNguoiNhap;
        $lohang->id_donvitinh = $request->txtDonViTinh;
        $lohang->thanhtien = $request->txtLHQuant * $donvi * $request->txtLHBuyPrice;

        $lohang->save();
        return redirect()->route('admin.lohang.list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm lô hàng thành công!']);
    }

    public function getEdit($id)
    {
        $lohang = DB::table('lohang')->where('id', $id)->first();

        $products = DB::table('sanpham')->get();
        foreach ($products as $key => $value) {
            $product[] = ['id' => $value->id, 'name' => $value->sanpham_ten];
        }

        $vendors = DB::table('nhacungcap')->get();
        foreach ($vendors as $key => $value) {
            $vendor[] = ['id' => $value->id, 'name' => $value->nhacungcap_ten];
        }

        $donvitinhs = DB::table('donvitinh')->get();
        foreach ($donvitinhs as $key => $value) {
            $donvitinh[] = ['id' => $value->id, 'name' => $value->donvitinh_ten, 'soluong' => $value->soluong];
        }

        $nguoinhaps = DB::table('nhanvien')->get();
        foreach ($nguoinhaps as $key => $value) {
            $nguoinhap[] = ['id' => $value->id, 'name' => $value->nhanvien_ten];
        }
        return view('admin.lohang.sua', compact('vendor', 'product', 'lohang', 'donvitinh', 'nguoinhap'));
    }

    public function postEdit(LohangEditRequest $request, $id)
    {
        $lohang = DB::table('lohang')->where('id', $id)->first();
        DB::table('lohang')->where('id', $id)
            ->update([
                'lohang_gia_mua_vao' => $request->txtLHBuyPrice,
                'lohang_so_luong_nhap' => $request->txtLHQuant,
                'lohang_so_luong_hien_tai' => ($request->txtLHQuant - $lohang->lohang_so_luong_da_ban + $lohang->lohang_so_luong_doi_tra),
                'sanpham_id' => $request->txtLHProduct,
                'nhacungcap_id' => $request->txtLHVendor,
                'sanpham_id' => $request->txtLHProduct,
                'maphieunhap' => $request->txtMaPhieuNhap,
                'ngay_nhap' => $request->txtNgayNhap,
                'id_nguoinhap' => $request->txtNguoiNhap,
                'id_donvitinh' => $request->txtDonViTinh,
                'thanhtien' => $request->txtLHQuant * $request->txtDonViTinh * $request->txtLHBuyPrice,
            ]);
        return redirect()->route('admin.lohang.list')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật lô hàng thành công!!!']);
    }

    public function getDelete($id)
    {
        DB::table('lohang')->where('id', $id)->delete();
        return redirect()->route('admin.lohang.list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa lô hàng thành công!!!']);
    }

    public function getNhaphang($id)
    {
        $sanpham = DB::table('sanpham')->where('id', $id)->first();

        $vendors = DB::table('nhacungcap')->get();
        foreach ($vendors as $key => $value) {
            $vendor[] = ['id' => $value->id, 'name' => $value->nhacungcap_ten];
        }

        return view('admin.lohang.nhaphang', compact('sanpham', 'vendor'));
    }

    public function postNhaphang(LohangAddRequest $request, $id)
    {
        $lohang = new Lohang;

        $lohang->lohang_gia_mua_vao = $request->txtLHBuyPrice;
        $lohang->lohang_so_luong_nhap = $request->txtLHQuant;
        $lohang->lohang_so_luong_da_ban = 0;
        $lohang->lohang_so_luong_doi_tra = 0;
        $lohang->lohang_so_luong_hien_tai = $request->txtLHQuant;
        $lohang->nhacungcap_id = $request->txtLHVendor;
        $lohang->sanpham_id = $id;

        $lohang->maphieunhap = $request->txtMaPhieuNhap;
        $lohang->ngay_nhap = $request->txtNgayNhap;
        $lohang->id_nguoinhap = $request->txtNguoiNhap;
        $lohang->id_donvitinh = $request->txtDonViTinh;
        $lohang->thanhtien = $request->txtDonViTinh * $request->txtLHBuyPrice;

        $lohang->save();
        return redirect()->route('admin.lohang.list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm lô hàng thành công!']);
    }
}