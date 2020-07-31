<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KhuyenmaiEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtKMTittle'  => 'required',
            'txtKMContent'  => 'required',
            'fImage' => 'required|mimes:jpeg,bmp,png'
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'fImage.mimes' => '<div><strong  style="color: red;">Vui lòng chọn đúng file ảnh</strong></div>'
        ];
    }
}
