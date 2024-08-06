<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'برجاء كتابة أسم النيابة أو الأدارة !',
            'governorate_id.required' => 'برجاء أختيار المحافظة !',
            'governorate_id.exists' => 'المحافظة غير مسجلة بسجلاتنا !',
        ];
    }
}
