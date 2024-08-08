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
                return redirect()->back()->with(['error' => 'عفوآ أسم العطلة موجودة من قبل !']);
            }
            DB::beginTransaction();
            $dataToInsert = new Employee();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['username'] = $request->username;
            $dataToInsert['password'] = $request->password;
            $dataToInsert['mobile'] = $request->mobile;
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
            return redirect()->route('dashboard.employees.index')->with('success', 'تم الموظف العطلة بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
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
        $other['appointments'] = Appointment::get();
        $other['governorates'] = Governorate::get();
        $other['cities'] = City::get();
        $other['branches'] = Branch::get();
        $other['job_categories'] = jobCategory::get();
        $other['job_grades'] = JobGrade::get();
        return view('dashboard.employees.edit', compact('other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
