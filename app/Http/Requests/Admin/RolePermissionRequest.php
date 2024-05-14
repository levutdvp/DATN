<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
            'name' => 'required|unique:roles,name,' . $this->id,
            'permission' => 'required|array|min:1',
            'permission.*' => 'exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường vai trò là bắt buộc.',
            'name.unique' => 'Vai trò đã tồn tại',
            'permission.required' => 'Phải chọn ít nhất một quyền.',
            'permission.array' => 'Quyền phải được chọn dưới dạng một mảng.',
            'permission.min' => 'Phải chọn ít nhất một quyền.',
            'permission.*.exists' => 'Một hoặc nhiều quyền đã chọn không tồn tại trong hệ thống.',
        ];
    }
}
