<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\loaisanpham;
use DB;

use App\Http\Requests;
use App\Http\Requests\LoaisanphamAddRequest;
use App\Http\Requests\LoaisanphamEditRequest;
use Input,File;


class LoaisanphamController extends Controller
{
    public function getList()
    {
        $data = DB::table('loaisanpham')->get();
    	return view('admin.loaisanpham.danhsach',compact('data'));
    }

    public function getAdd()
    {
    	$data = DB::table('nhom')->get();
    	foreach ($data as $key => $val)
    	{
    		$nhom[] = ['id' => $val->id, 'name'=>$val->nhom_ten];
    	}
    	return view('admin.loaisanpham.them', compact('nhom'));
    }

    public function postAdd(LoaisanphamAddRequest $request)
    {
    	$loaisanpham = new Loaisanpham;

        $imageName = $request->file('fImage')->getClientOriginalName();
        $request->file('fImage')->move('resources/upload/loaisanpham/', $imageName);

    	$loaisanpham->loaisanpham_ten = $request->txtLSPName;
    	$loaisanpham->loaisanpham_url = Replace_TiengViet($request->txtLSPName);
    	$loaisanpham->loaisanpham_mo_ta = $request->txtLSPIntro;
        $loaisanpham->nhom_id = $request->txtLSPParent;
    	$loaisanpham->loaisanpham_anh = $imageName; 
    	
		$loaisanpham->save();
        return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success', 'flash_message'=>'Thêm loại sản phẩm thành công!']);
    }

    public function getDelete($id)
    {
        $loaisanpham = DB::table('loaisanpham')->where('id',$id)->first();
        $img = 'resources/upload/loaisanpham/'.$loaisanpham->loaisanpham_anh;
        File::delete($img);

        DB::table('loaisanpham')->where('id',$id)->delete();

        return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công loại sản phẩm!']);
    }

    public function getEdit($id)
    {
        $loaisp = DB::table('loaisanpham')->where('id',$id)->first();
        $data = DB::table('nhom')->get();
        foreach ($data as $key => $val) {
            $nhom[] = ['id' => $val->id, 'name' => $val->nhom_ten];
        }

        return view('admin.loaisanpham.sua',compact('nhom','loaisp','id'));
    }

    public function postEdit(LoaisanphamEditRequest $request, $id)
    {
        $fImage = $request->fImage;

        $img_current = 'resources/upload/loaisanpham/'.$request->fImageCurrent;

        if(!empty($fImage))
        {
            $filename = $fImage->getClientOriginalName();

            DB::table('loaisanpham')->where('id',$id)
                                    ->update([
                                        'loaisanpham_ten' => $request->txtLSPName,
                                        'loaisanpham_url' => Replace_TiengViet($request->txtLSPName),
                                        'nhom_id' => $request->txtLSPParent,
                                        'loaisanpham_mo_ta' => $request->txtLSPIntro,
                                        'loaisanpham_anh' => $filename
                                    ]);


            $fImage->move('resources/upload/loaisanpham/',$filename);
            File::delete($img_current);
        }
        else
        {
            DB::table('loaisanpham')->where('id',$id)
                                    ->update([
                                        'loaisanpham_ten' => $request->txtLSPName,
                                        'loaisanpham_url' => Replace_TiengViet($request->txtLSPName),
                                        'loaisanpham_mo_ta' => $request->txtLSPIntro,
                                        'nhom_id' => $request->txtLSPParent

                                    ]);
        }
        return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success', 'flash_message' => 'Sửa loại sản phẩm thành công!']);
    }
}