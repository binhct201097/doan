<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SanphamAddRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txtSPName' => 'required|unique:sanpham,sanpham_ten',
            'txtSPCate' => 'required',
            'txtSPIntro' => 'required',
            'txtSPImage' => 'required|mimes:jpeg,bmp,png',

        ];
    }

    public function messages()
    {
        return [
            'required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'unique' => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'mimes' => '<div><strong  style="color: red;">Vui lòng chọn đúng file ảnh</strong></div>',
        ];
    }
}