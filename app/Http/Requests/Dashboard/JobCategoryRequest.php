<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class JobCategoryRequest extends FormRequest
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
            'name' => 'required|string',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'برجاء كتابة أسم المسمى الوظيفى !',
            'status.required' => 'برجاء أختيار حالة التفعيل !',
        ];
    }
}
