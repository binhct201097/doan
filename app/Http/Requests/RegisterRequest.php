<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'name'   =>'required|unique:users,name',
            'email'  =>'required|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^',
            'password'   =>'required',
            'password_confirmation' =>'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'required'=> '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'name.unique'   =>'<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'email.unique'  =>'<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'email.regex'  =>'<div><strong  style="color: red;">Email không đúng định dạng!</strong></div>',
            'password.same' =>'<div><strong  style="color: red;">Mật khẩu không trùng khớp!</strong></div>'
        ];
    }
}
