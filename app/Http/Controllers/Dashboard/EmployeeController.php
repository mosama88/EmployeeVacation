<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Appointment;
use App\Models\Governorate;
use App\Models\jobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
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
