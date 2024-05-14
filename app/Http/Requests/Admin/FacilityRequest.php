<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FacilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'icon' => 'required',
            // sửa
            'description' => 'required',
        ];
    }

    function messages(){
        return [
            'name.required' => 'Tên bắt buộc nhập!', 
            'icon.required' => 'Icon bắt buộc chọn!', 
            'description.required'  => 'Mô tả bắt buộc nhập!'
        ]; 
    }
}
