<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
        $holidayId = $this->route('holiday'); // Adjust according to your route parameter

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('holidays')->ignore($holidayId), // Exclude the current record
            ],

            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'برجاء كتابة اسم العطلة !',
            'name.unique' => 'أسم العطلة موجود بالفعل !',
            'from.required' => 'برجاء اختيار تاريخ البداية !',
            'from.date' => 'تاريخ البداية يجب أن يكون بتاريخ صالح !',
            'to.required' => 'برجاء اختيار تاريخ النهاية !',
            'to.date' => 'تاريخ النهاية يجب أن يكون بتاريخ صالح !',
            'to.after_or_equal' => 'تاريخ النهاية يجب أن يكون بعد أو يساوي تاريخ البداية !',
        ];
    }
}
