<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderEditRequest;
use App\Slider;
use DB;
use File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function getList()
    {
        $data = DB::table('slides')->get();
        return view('admin.slides.danhsach', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.slides.them');
    }

    public function postAdd(SliderAddRequest $request)
    {
        $slides = new Slider;

        $imageName = $request->file('fImage')->getClientOriginalName();
        $request->file('fImage')->move('resources/upload/slides/', $imageName);

        $slides->anh = $imageName;
        $slides->trangthai = $request->txtNName;
        $slides->ten = $request->ten;
        $slides->link = $request->link;

        $slides->save();

        return redirect()->route('admin.slides.list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm slider thành công!!!']);
    }

    public function getEdit($id)
    {
        $slides = DB::table('slides')->where('id', $id)->first();
        return view('admin.slides.sua', compact('slides'));
    }

    public function postEdit(SliderEditRequest $request, $id)
    {
        $fImage = $request->fImage;
        $img_current = 'resources/upload/slides/' . $request->fImageCurrent;

        if (!empty($fImage)) {
            $filename = $fImage->getClientOriginalName();

            DB::table('slides')->where('id', $id)
                ->update([
                    'anh' => $filename,
                    'trangthai' => $request->txtNName,
                    'link' => $request->link,
                    'ten' => $request->ten,
                ]);
            $fImage->move('resources/upload/slides/', $filename);
            File::delete($img_current);
        } else {
            DB::table('slides')->where('id', $id)
                ->update([
                    'trangthai' => $request->txtNName,
                ]);
        }

        return redirect()->route('admin.slides.list')->with(['flash_level' => 'success', 'flash_message' => 'Sửa slider thành công!!!']);
    }

    public function getChange(Request $request, $id, $status)
    {
        DB::table('slides')
            ->where('id', $id)
            ->update([
                'trangthai' => $status,
            ]);
        return redirect()->route('admin.slides.list')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật slider thành công!!!']);
    }

    public function getDelete($id)
    {
        $slides = DB::table('slides')->where('id', $id)->first();
        $img = 'resources/upload/slides/' . $slides->anh;
        File::delete($img);

        DB::table('slides')->where('id', $id)->delete();
        return redirect()->route('admin.slides.list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa slider thành công!!!']);
    }
}