<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'metaTitle' => 'required|max:50',
            'title' => 'required|max:155',
            'image' => 'mimes:jpeg,png,jpg,gif|max:4096',
            'metaDescription' => 'required|max:255|min:5',
            'description' => 'required|max:10000|min:5',
        ];
    }

    function messages(){
        return [
            'metaTitle.required' => 'Trường không được bỏ trống',
            'title.required' => 'Trường không được bỏ trống',
            'description.required'  => 'Trường không được bỏ trống',
            'metaDescription.required'  => 'Trường không được bỏ trống',

            'metaTitle.max' => 'Phải dưới 50 ký tự',
            'title.max' => 'Phải dưới 155 ký tự',
            'description.max' => 'Phải dưới 10000 ký tự',
            'metaDescription.max' => 'Phải dưới 255 ký tự',

            'description.min' => 'Phải trên 5 ký tự',
            'metaDescription.min' => 'Phải trên 5 ký tự',

            'image.mimes' => 'Phải là file ảnh JPEG, PNG, JPG, GIF',
            'image.size' => 'Dung lượng phải dưới 2Mb',
        ];
    }
}
