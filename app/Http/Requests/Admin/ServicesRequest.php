<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicesRequest extends FormRequest
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
            'name' => 'required|min:4|max:20|unique:services,name,' . $this->id,
            'price' => ['required', 'numeric', 'gte:1'],
            'date_number' => ['required', 'numeric', 'gte:1'],
            'color' =>['max:255'],
            'icon'  =>['max:255'],
            'description' => ['required', 'min:5', 'max:999'],
        ];
    }
    public function messages(): array
    {
        return [
            // Name
            "name.required" => "Tên không được để trống",
            "name.min" => "Số kí tự phải lớn hơn 4",
            "name.max" => "Số kí tự phải nhỏ hơn 20",
            "name.unique" => "Tên dịch vụ không được trùng",
            // Price
            "price.required"=>"Giá dịch vụ không được để trống",
            "price.numeric"=>"Giá dịch vụ phải là số",
            "price.gte"=>"Giá dịch vụ phải lớn hơn 1",
            // Date_number
            "date_number.required"=>"Số ngày dịch vụ không được để trống",
            "date_number.numeric"=>"Số ngày dịch vụ phải là số",
            "date_number.gte"=>"Số ngày dịch vụ phải lớn hơn 1",
            //Color
            "color.max"=>"Số kí tự phải nhỏ hơn 255",
            //icon
            
            // Description
            "description.required"=>"Mô tả không được để trống",
            "description.min"=>"Số kí tự phải lớn hơn 5",
            "description.max"=>"Số kí tự phải nhỏ hơn 999",
        ];
    }
}
