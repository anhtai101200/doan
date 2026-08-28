<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'    => 'required',
            'email'   => 'required|email',
            'password' => 'nullable',
            'phone'   => 'nullable|max:20',
            'address' => 'nullable|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_country' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email'    => 'Email không đúng định dạng.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'avatar.image' => 'Avatar phải là hình ảnh.',
            'avatar.mimes' => 'Avatar chỉ được có định dạng jpeg, png, jpg hoặc gif.',
            'avatar.max' => 'Avatar không được lớn hơn 1MB.',
            'id_country.required'  => 'Vui lòng chọn quốc gia.',
        ];
    }
}
