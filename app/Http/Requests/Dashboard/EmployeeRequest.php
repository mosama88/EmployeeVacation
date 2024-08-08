<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:100',
            'username' => 'nullable|string|min:5|max:30|unique:users,username,' . $this->id,
            'password' => 'nullable|string|min:5|max:20',
            'mobile' => 'required|string|min:11|unique:employees,mobile,' . $this->id,
            'gender' => 'required|in:1,2',
            'address' => 'required|string|min:5|max:200',
            'hiring_date' => 'required|date',
            'start_from' => 'nullable|date|after:hiring_date',
            'birth_date' => 'required|date',
            'num_vacation_days' => 'required|date',
            'add_service' => 'nullable|numeric',
            'years_service' => 'required|numeric',
            'appointment_id' => 'required|exists:appointments,id',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'nullable|exists:cities,id',
            'branche_id' => 'required|exists:branches,id',
            'job_category_id' => 'required|exists:job_categories,id',
            'job_grade_id' => 'required|exists:job_grades,id',
            'status' => 'nullable|in:1,2',
            'notes' => 'nullable|string|min:5|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا صالحًا.',
            'name.min' => 'الاسم يجب أن يحتوي على 5 أحرف على الأقل.',
            'name.max' => 'الاسم يجب ألا يتجاوز 100 حرف.',

            'username.nullable' => 'حقل اسم المستخدم اختياري.',
            'username.string' => 'اسم المستخدم يجب أن يكون نصًا صالحًا.',
            'username.min' => 'اسم المستخدم يجب أن يحتوي على 5 أحرف على الأقل.',
            'username.max' => 'اسم المستخدم يجب ألا يتجاوز 30 حرفاً.',
            'username.unique' => 'اسم المستخدم هذا موجود بالفعل.',

            'password.nullable' => 'حقل كلمة المرور اختياري.',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا صالحًا.',
            'password.min' => 'كلمة المرور يجب أن تحتوي على 5 أحرف على الأقل.',
            'password.max' => 'كلمة المرور يجب ألا تتجاوز 20 حرفاً.',

            'mobile.required' => 'حقل رقم الجوال مطلوب.',
            'mobile.string' => 'رقم الجوال يجب أن يكون نصًا صالحًا.',
            'mobile.min' => 'رقم الجوال يجب أن يحتوي على 11 رقمًا على الأقل.',
            'mobile.unique' => 'رقم الجوال هذا موجود بالفعل.',

            'gender.required' => 'حقل الجنس مطلوب.',
            'gender.in' => 'القيمة المختارة للجنس غير صحيحة.',

            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'العنوان يجب أن يكون نصًا صالحًا.',
            'address.min' => 'العنوان يجب أن يحتوي على 5 أحرف على الأقل.',
            'address.max' => 'العنوان يجب ألا يتجاوز 200 حرف.',

            'hiring_date.required' => 'حقل تاريخ التعيين مطلوب.',
            'hiring_date.date' => 'تاريخ التعيين يجب أن يكون تاريخًا صالحًا.',

            'start_from.nullable' => 'حقل بداية الخدمة اختياري.',
            'start_from.date' => 'بداية الخدمة يجب أن يكون تاريخًا صالحًا.',
            'start_from.after' => 'بداية الخدمة يجب أن تكون بعد تاريخ التعيين.',

            'birth_date.required' => 'حقل تاريخ الميلاد مطلوب.',
            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخًا صالحًا.',

            'num_vacation_days.required' => 'حقل عدد أيام الإجازة مطلوب.',
            'num_vacation_days.numeric' => 'عدد أيام الإجازة يجب أن يكون رقمًا صالحًا.',

            'add_service.nullable' => 'حقل إضافة خدمة اختياري.',
            'add_service.numeric' => 'إضافة خدمة يجب أن تكون رقمًا صالحًا.',

            'years_service.required' => 'حقل سنوات الخدمة مطلوب.',
            'years_service.numeric' => 'سنوات الخدمة يجب أن تكون رقمًا صالحًا.',

            'appointment_id.required' => 'حقل المعرف مطلوب.',
            'appointment_id.exists' => 'المعرف المحدد غير موجود.',

            'governorate_id.required' => 'حقل المحافظة مطلوب.',
            'governorate_id.exists' => 'المحافظة المحددة غير موجودة.',

            'city_id.nullable' => 'حقل المدينة اختياري.',
            'city_id.exists' => 'المدينة المحددة غير موجودة.',

            'branche_id.required' => 'حقل الفرع مطلوب.',
            'branche_id.exists' => 'الفرع المحدد غير موجود.',

            'job_category_id.required' => 'حقل تصنيف الوظيفة مطلوب.',
            'job_category_id.exists' => 'تصنيف الوظيفة المحدد غير موجود.',

            'job_grade_id.required' => 'حقل الدرجة الوظيفية مطلوب.',
            'job_grade_id.exists' => 'الدرجة الوظيفية المحددة غير موجودة.',

            'status.nullable' => 'حقل الحالة اختياري.',
            'status.in' => 'القيمة المختارة للحالة غير صحيحة.',

            'notes.nullable' => 'حقل الملاحظات اختياري.',
            'notes.string' => 'الملاحظات يجب أن تكون نصًا صالحًا.',
            'notes.min' => 'الملاحظات يجب أن تحتوي على 5 أحرف على الأقل.',
            'notes.max' => 'الملاحظات يجب ألا تتجاوز 100 حرف.',
        ];
    }
}
