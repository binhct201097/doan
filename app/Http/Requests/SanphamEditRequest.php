<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SanphamEditRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txtSPName' => 'required',
            'txtSPCate' => 'required',
            'txtSPIntro' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
        ];
    }
}