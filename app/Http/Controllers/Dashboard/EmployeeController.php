<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Appointment;
use App\Models\Governorate;
use App\Models\jobCategory;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EmployeeRequest;

class EmployeeController extends Controller
{

    use UploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::select("*")->orderBy('id', 'DESC')->get();
        return view('dashboard.employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['appointments'] = Appointment::get();
        $other['governorates'] = Governorate::get();
        $other['cities'] = City::get();
        $other['branches'] = Branch::get();
        $other['job_categories'] = jobCategory::get();
        $other['job_grades'] = JobGrade::get();
        return view('dashboard.employees.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $checkExists = Employee::select("*")->where('name', $request->name)->first();
            if (!empty($checkExists)) {
                return response()->json(['error' => 'عفوآ أسم الموظف موجودة من قبل !'], 422);
            }
            DB::beginTransaction();
            $dataToInsert = new Employee();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['username'] = $request->username;
            $dataToInsert['password'] = $request->password;
            $dataToInsert['mobile'] = $request->mobile;
            $dataToInsert['address'] = $request->address;
            $dataToInsert['gender'] = $request->gender;
            $dataToInsert['hiring_date'] = $request->hiring_date;
            $dataToInsert['start_from'] = $request->start_from;
            $dataToInsert['birth_date'] = $request->birth_date;
            $dataToInsert['num_vacation_days'] = $request->num_vacation_days;
            $dataToInsert['add_service'] = $request->add_service;
            $dataToInsert['years_service'] = $request->years_service;
            $dataToInsert['appointment_id'] = $request->appointment_id;
            $dataToInsert['governorate_id'] = $request->governorate_id;
            $dataToInsert['city_id'] = $request->city_id;
            $dataToInsert['branche_id'] = $request->branche_id;
            $dataToInsert['job_category_id'] = $request->job_category_id;
            $dataToInsert['job_grade_id'] = $request->job_grade_id;
            $dataToInsert['notes'] = $request->notes;
            $dataToInsert['status'] = 1;
            $dataToInsert['created_by'] = auth()->user()->id;

            $dataToInsert->save();

            $this->verifyAndStoreImage($request, 'photo', 'employees/', 'upload_image', $dataToInsert->id, 'App\Models\Employee');

            DB::commit();
            return response()->json(['success' => 'تم أضافة بيانات الموظف بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = Employee::findOrFail($id);
        $other['appointments'] = Appointment::get();
        $other['governorates'] = Governorate::get();
        $other['cities'] = City::get();
        $other['branches'] = Branch::get();
        $other['job_categories'] = jobCategory::get();
        $other['job_grades'] = JobGrade::get();
        return view('dashboard.employees.edit', compact('other', 'info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($request->id);
        try {
            $checkExists = Employee::select("*")->where('name', $request->name)->first();
            if (!empty($checkExists)) {
                return response()->json(['error' => 'عفوآ أسم الموظف موجودة من قبل !'], 422);
            }
            DB::beginTransaction();
            $dataToUpdate = new Employee();
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['username'] = $request->username;
            $dataToUpdate['password'] = $request->password;
            $dataToUpdate['mobile'] = $request->mobile;
            $dataToUpdate['address'] = $request->address;
            $dataToUpdate['gender'] = $request->gender;
            $dataToUpdate['hiring_date'] = $request->hiring_date;
            $dataToUpdate['start_from'] = $request->start_from;
            $dataToUpdate['birth_date'] = $request->birth_date;
            $dataToUpdate['num_vacation_days'] = $request->num_vacation_days;
            $dataToUpdate['add_service'] = $request->add_service;
            $dataToUpdate['years_service'] = $request->years_service;
            $dataToUpdate['appointment_id'] = $request->appointment_id;
            $dataToUpdate['governorate_id'] = $request->governorate_id;
            $dataToUpdate['city_id'] = $request->city_id;
            $dataToUpdate['branche_id'] = $request->branche_id;
            $dataToUpdate['job_category_id'] = $request->job_category_id;
            $dataToUpdate['job_grade_id'] = $request->job_grade_id;
            $dataToUpdate['notes'] = $request->notes;
            $dataToUpdate['status'] = $request->status;
            $dataToUpdate['updated_by'] = auth()->user()->id;

            $employee->update($dataToUpdate);

            // update photo
            if ($request->has('photo')) {
                // Delete old photo
                if ($employee->image) {
                    $old_img = $employee->image->filename;
                    $this->Delete_attachment('upload_image', 'employees/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'employees', 'upload_image', $request->id, 'App\Models\employee');
            }

            DB::commit();
            return response()->json(['success' => 'تم أضافة بيانات الموظف بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $data = Employee::select("*")->where('id', $id)->first();


        // معالجة الحذف الفردي
        if ($request->page_id == 1) {
            // التحقق من وجود صورة
            if ($data->image) {
                $filename = $data->image->filename;
                $path = 'employees/' . $filename;

                // حذف الصورة
                $this->Delete_attachment('upload_image', $path, $data->image->id);
            }

            // حذف الموظف
            Employee::destroy($id);

            session()->flash('success', 'تم حذف الموظف بنجاح');
            return back();
        }

        // العودة مع رسالة خطأ إذا لم يكن $request->page_id يساوي 1
        session()->flash('error', 'خطأ في عملية الحذف');
        return back();
    }
}
