<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BaivietEditRequest;
use App\Http\Requests\BaivietAddRequest;
use App\Baiviet;
use App\Sanpham;
use App\Nguyenlieu;
use DB;
use Input,File;

class BaivietController extends Controller
{
    public function getList()
    {
    	$data = DB::table('baiviet')->orderBy('id','DESC')->get();
    	return view('admin.baiviet.danhsach', compact('data'));
    }

    public function getAdd()
    {
    	$data = DB::table('sanpham')->orderBy('id','DESC')->get();
    	return view('admin.baiviet.them', compact('data'));
    }

    public function postAdd(BaivietAddRequest $request)
    {
    	$filename = $request->file('fImage')->getClientOriginalName();
    	$request->file('fImage')->move('resources/upload/baiviet/',$filename);

    	$baiviet = new Baiviet;

        $baiviet->baiviet_tieu_de = $request->txtBVTittle;
        $baiviet->baiviet_tom_tat = $request->txtBVResum;
        $baiviet->baiviet_noi_dung = $request->txtBVContent;
        $baiviet->baiviet_url = Replace_TiengViet($request->txtBVTittle);
        $baiviet->baiviet_luot_xem = 1;
        $baiviet->baiviet_anh = $filename;

        $baiviet->save();

        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $nguyenlieu = new Nguyenlieu;
            $nguyenlieu->sanpham_id = $item;
            $nguyenlieu->baiviet_id = $baiviet->id;
            $nguyenlieu->save();
        }

    	return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Đăng tin thành công!!!']);
    }

    public function getDelete($id)
    {
        $baiviet = DB::table('baiviet')->where('id',$id)->first();
        $img = 'resources/upload/baiviet/'.$baiviet->baiviet_anh;
        File::delete($img);
        DB::table('baiviet')->where('id',$id)->delete();
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function getEdit($id)
    {
        $baiviet = DB::table('baiviet')->where('id',$id)->first();
        $nguyenlieu = DB::table('nguyenlieu')->select('sanpham_id')->where('baiviet_id',$id)->get();
        foreach ($nguyenlieu as $key => $value) {
            $nglieu[] = $value->sanpham_id;
        }

        if(!empty($nglieu)) {
            $sanpham1 = DB::table('sanpham')->whereIn('id',$nglieu)->get();
        } else {
            $sanpham1 = DB::table('sanpham')->whereIn('id',['0'])->get();
        }

        if(empty($nglieu)) {
            $sanpham2 = DB::table('sanpham')->whereNotIn('id',['0'])->get();
        } else {
            $sanpham2 = DB::table('sanpham')->whereNotIn('id',$nglieu)->get();
        }
        return view('admin.baiviet.sua',compact('baiviet','sanpham1','sanpham2'));
    }

    public function postEdit(BaivietEditRequest $request, $id)
    {
        $fImage = $request->file('fImage');
        $img_current = 'resources/upload/baiviet/'.$request->fImageCurrent;

        if(!empty($fImage)) {
            $filename = $request->file('fImage')->getClientOriginalName();
            $fImage->move('resources/upload/baiviet/',$filename);
            File::delete($img_current);

            DB::table('baiviet')->where('id',$id)
                                ->update([
                                    'baiviet_tieu_de' => $request->txtBVTittle,
                                    'baiviet_tom_tat' => $request->txtBVResum,
                                    'baiviet_noi_dung' => $request->txtBVContent,
                                    'baiviet_url' => Replace_TiengViet($request->txtBVTittle),
                                    'baiviet_anh' => $filename
                                ]);
        } else {
            DB::table('baiviet')->where('id',$id)
                                ->update([
                                    'baiviet_tieu_de' => $request->txtBVTittle,
                                    'baiviet_tom_tat' => $request->txtBVResum,
                                    'baiviet_noi_dung' => $request->txtBVContent,
                                    'baiviet_url' => Replace_TiengViet($request->txtBVTittle)
                                ]);
        }

        DB::table('nguyenlieu')->where('baiviet_id',$id)->delete();
        $data = $request->input('products',[]);
        foreach ($data as $item) {
            $nguyenlieu = new Nguyenlieu;
            $nguyenlieu->baiviet_id = $id;
            $nguyenlieu->sanpham_id = $item;
            $nguyenlieu->save();
        }

        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công!!!']);
    }
}
