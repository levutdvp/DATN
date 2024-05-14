<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'email' => 'required|email:rfc,dns',
            'support_phone' => 'required|numeric|digits:10',
            'address' => 'required|max:255',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif',
            'meta_title' => 'required|max:255',
            'meta_author' => 'required|max:255',
            'meta_description' => 'required|max:255',
            'meta_keyword' => 'required|max:255',
            'analytic' => 'max:255',
        ];
    }


    public function messages()
{
    return [
        'logo.image' => 'Trường logo phải là một tệp hình ảnh.',
        'logo.mimes' => 'Tệp logo phải có định dạng jpeg, png, jpg hoặc gif.',
        'email.required' => 'Trường email là bắt buộc.',
        'email.email' => 'Email phải có định dạng hợp lệ theo RFC và DNS.',
        'support_phone.required' => 'Trường số điện thoại hỗ trợ là bắt buộc.',
        'support_phone.numeric' => 'Số điện thoại hỗ trợ phải là một số.',
        'support_phone.digits' => 'Số điện thoại hỗ trợ phải có đúng :digits chữ số.',
        'address.required' => 'Trường địa chỉ là bắt buộc.',
        'address.max' => 'Địa chỉ không được dài quá :max ký tự.',
        'favicon.image' => 'Biểu tượng trang web phải là một tệp hình ảnh.',
        'favicon.mimes' => 'Biểu tượng trang web phải có định dạng jpeg, png, jpg hoặc gif.',
        'meta_title.required' => 'Trường tiêu đề trang là bắt buộc.',
        'meta_title.max' => 'Tiêu đề trang không được dài quá :max ký tự.',
        'meta_author.required' => 'Trường tác giả là bắt buộc.',
        'meta_author.max' => 'Tác giả không được dài quá :max ký tự.',
        'meta_description.required' => 'Trường mô tả là bắt buộc.',
        'meta_description.max' => 'Mô tả không được dài quá :max ký tự.',
        'meta_keyword.required' => 'Trường từ khóa là bắt buộc.',
        'meta_keyword.max' => 'Từ khóa không được dài quá :max ký tự.',
        'analytic.max' => 'Google analytic không được dài quá :max ký tự.',
    ];
}
}
