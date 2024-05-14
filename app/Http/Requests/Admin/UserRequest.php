<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        
        $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        $rules = [
                            'name' => 'required|min:5|',
                            'email' => 'required|min:5|unique:users',
                            'password' => ['required', 'string', 'regex:/^(?=.*[A-Z])(?=.*\d).+$/', 'min:6', 'max:35'],
                            'phone' => 'required|regex:/^[0-9]{9,}$/|max:12|min:9|unique:users'
                        ];
                        break;
                    case 'update':
                        $id = $this->route('id');
                        $rules = [
                            'name' => 'required|min:5|',
                            'email' => [
                                'required', Rule::unique('users')->ignore($id), 'max:255',
                            ],
                            'password' => ['required', 'string', 'regex:/^(?=.*[A-Z])(?=.*\d).+$/', 'min:6', 'max:35'],
                            'phone' => 'required', 'regex:/^[0-9]{9,}$/', 'max:12', 'min:9', Rule::unique('users')->ignore($id)
                        ];
                        break;
                    default:
                        break;
                }
                break;
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'name.min' => 'Tên phải có ít nhất 5 ký tự.',

            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.min' => 'Địa chỉ email phải có ít nhất 5 ký tự.',
            'email.unique' => 'Địa chỉ email này đã được sử dụng.',

            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa và ít nhất một số.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không được quá 12 ký tự.',
            'phone.min' => 'Số điện thoại phải có ít nhất 9 ký tự.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng.',

            'avatar.image' => 'Phải chọn 1 là hình ảnh.',
    ];
}
}
