<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'txtNName' => 'required',
            'fImage' => 'required|mimes:jpeg,bmp,png',
            'ten' => 'required',
            'link' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'txtNName.required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'ten.required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'link.required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'fImage.required' => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'fImage.mimes' => '<div><strong  style="color: red;">Vui lòng chọn đúng file ảnh</strong></div>',
        ];
    }
}