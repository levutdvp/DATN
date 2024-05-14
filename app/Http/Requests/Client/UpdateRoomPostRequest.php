<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomPostRequest extends FormRequest
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
            'name' => 'required|unique:room_posts,name,' . $this->id,
            'price' => 'required|integer',
            'address' => 'required',
            'address_full' => 'required',
            'acreage' => 'required',
            'empty_room' => 'required|integer',
            'description' => 'required|min:300',
            'managing' => 'required',
            'image.*' => 'required',
            'ward_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'facility' => 'required',
            'surrounding' => 'required',
            'category_room_id' => 'required',
            'fullname' => 'required',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'zalo' => 'nullable|regex:/^[0-9]{10}$/'
        ];
    }
    function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống',
            'name.unique' => 'Tiêu đề đã tồn tại',

            'price.integer' => 'Giá tiền phải là số',
            'price.required' => 'Giá tiền không được để trống',

            'acreage.required' => 'Diện tích không được để trống',
            'acreage.integer' => 'Diện tích phải là số',

            'empty_room.required' => 'Số phòng trống không được để trống',
            'empty_room.integer' => 'Số phòng trống phải là số',

            'address.required' => 'Địa chỉ không được để trống',
            'address.address_full' => 'Địa chỉ không được để trống',

            'description.required' => 'Mô tả không được để trống',
            'description.min' => 'Mô tả tối thiểu 300 kí tự',
            'ward_id.required' => 'Xã phường bắt buộc phải chọn',
            'district_id.required' => 'Quận huyện bắt buộc phải chọn',
            'city_id.required' => 'Thành phố bắt buộc phải chọn',
            'facility.required' => 'Tiện ích bắt buộc phải chọn',
            'surrounding.required' => 'Môi trường xung quanh bắt buộc phải chọn',
            'category_room_id.required' => 'Danh mục bắt buộc phải chọn',
            'fullname.required' => 'Họ tên không được để tr',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'zalo.required' => 'Zalo không được để trống',
            'zalo.regex' => 'Zalo không hợp lệ',
            'imageroom.required' => 'Ảnh nổi bật không được để trống',
        ];
    }
}
