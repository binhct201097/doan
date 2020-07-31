<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NhanvienEditRequest extends Request
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
            'txtNVName' =>'required',
            'txtNVID'   =>'required',
            'txtNVPhone'=>'required',
            'txtNVDate' =>'required',
            'txtNVAddress'=>'required',
            'txtUsername'   =>'required',
            'txtEmail'  =>'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^',
            'txtPass'   =>'required',
            'txtRePass' =>'required|same:txtPass',
            'txtRole' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=> '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtEmail.regex'  =>'<div><strong  style="color: red;">Email không đúng định dạng!</strong></div>',
            'txtRePass.same' =>'<div><strong  style="color: red;">Mật khẩu không trùng khớp!</strong></div>'
        ];
    }
}
