<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'url' => 'required|url',
            'location' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'Hình ảnh phải có định dạng là jpeg, png, jpg hoặc gif.',
            'image.required' => 'Hình ảnh phải được chọn',
            'url.required' => 'Trường URL là bắt buộc.',
            'url.url' => 'Trường URL phải là một địa chỉ URL hợp lệ.',
            'location.required' => 'Trường vị trí là bắt buộc.',
        ];
    }
}
