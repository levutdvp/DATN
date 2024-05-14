<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            //
            'old_password' => ['required', 'string','regex:/^(?=.*[A-Z])(?=.*\d).+$/', 'min:6', 'max:35'],
            'password' => ['required', 'string','regex:/^(?=.*[A-Z])(?=.*\d).+$/', 'min:6', 'max:35', 'confirmed']
        ];
    }
    public function messages(): array
    {
        return [
            'old_password.required' => 'Mật khẩu bắt buộc nhập.',
            'old_password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'old_password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.required' => 'Chưa nhập mật khẩu mới.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa và ít nhất một số.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
        ];
    }
}
