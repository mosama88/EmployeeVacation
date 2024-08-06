<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\JobGrade;
use App\Models\jobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = jobCategory::select("*")->orderBy("id", "DESC")->get();
        return view('dashboard.jobCategories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jobCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataToInsert = new jobCategory();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['status'] = 1;
            $dataToInsert['created_by'] = auth()->user()->id;

            $dataToInsert->save();

            DB::commit();
            return redirect()->route('dashboard.jobCategories.index')->with('success', 'تم أضافة المسمى الوظيفي بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ ما!' . $ex->getMessage()])->withInput();
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
    public function edit(string $id)
    {
        return view('dashboard.jobCategories.edit');
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
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $jobGrades = jobCategory::findOrFail($id);
            $jobGrades->delete();
            DB::commit();
            return redirect()->route('dashboard.jobCategories.index')->with('success', 'تم حذف المسمى الوظيفي بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ ما!' . $ex->getMessage()])->withInput();
        }
    }
}
