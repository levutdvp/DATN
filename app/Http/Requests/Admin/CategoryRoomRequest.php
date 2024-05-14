<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRoomRequest extends FormRequest
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
            'name' => 'required|min:1|unique:category_rooms,name,'.$this->id,
            'description' => 'required|min:1|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            // name
            "name.required" => "Tên không được để trống",
            "name.min" => "Số kí tự phải lớn hơn 4",
            "name.unique" => "Tên danh mục không được trùng",

            // Description
            "description.required"=>"Mô tả không được để trống",
            "description.min"=>"Số kí tự phải lớn hơn 5",
            "description.max"=>"Số kí tự phải nhỏ hơn 255",
        ];
    }
}
