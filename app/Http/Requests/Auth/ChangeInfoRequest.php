<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangeInfoRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'phone' => ['required', 'regex:/^0[0-9]{7,11}$/', 'min:8', 'max:12', 'unique:users,phone,' . $this->id],
            'avatar' => ['image'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Họ tên là trường bắt buộc.',
            'name.string' => 'Họ tên phải là một chuỗi ký tự.',
            'name.min' => 'Họ tên phải có ít nhất :min ký tự.',
            'name.max' => 'Họ tên không được quá :max ký tự.',
            'avatar.image' => 'Ảnh đại diện không hợp lệ.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống.',
            'phone.regex' => 'Số điện thoại phải là một số điện thoại Việt Nam hợp lệ.',
            'phone.min' => 'Số điện thoại phải có ít nhất :min ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.'
        ];
    }
}
