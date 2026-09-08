<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'hinhanh' => 'required',
            'hinhanh.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Vui lòng nhập name.',
            'price.required'  => 'Vui lòng nhập gia.',
            'detail.required'  => 'Vui lòng nhập mo ta.',
            'hinhanh.required'  => 'Vui lòng nhập hinh anh.'

        ];
    }
}
