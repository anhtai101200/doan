<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'    => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'nullable|max:255',
            'content' => 'nullable|max:255',
            
        ];
    }

    public function messages()
    {
        return [
            'title.required'  => 'Vui lòng nhập tiêu đề.',
            'content.max' => 'Content không được vượt quá 255 ký tự.',
            'description.max' => 'Description chỉ không được vượt quá 255 ký tự.',
            'image.image' => 'Image phải là hình ảnh.',
            'image.mimes' => 'Image chỉ được có định dạng jpeg, png, jpg hoặc gif.',
            'image.max' => 'Image không được lớn hơn 1MB.',
        ];
    }
}
