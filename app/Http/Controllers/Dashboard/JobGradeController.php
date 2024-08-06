<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\JobGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JobGrade::select("*")->orderBy("id", "DESC")->get();
        return view('dashboard.jobGrades.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jobGrades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $chechExists = JobGrade::select("*")->where("name", $request->name)->first();
            if (!empty($chechExists)) {
                return redirect()->back()->with(['error' => 'عفوآ أسم الدرجه الوظيفية موجود من قبل!']);
            }
            DB::beginTransaction();
            $dataToInsert = new JobGrade();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['created_by'] = auth()->user()->id;
            $dataToInsert->save();
            DB::commit();
            return redirect()->route('dashboard.jobGrades.index')->with('success', 'تم أضافة الدرجه الوظيفية بنجاح');
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
    public function edit($id)
    {
        return view('dashboard.jobGrades.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $jobGrades = JobGrade::findOrFail($id);
            $jobGrades->update();
            DB::commit();
            return redirect()->route('dashboard.jobGrades.index')->with('success', 'تم تعديل الدرجه الوظيفية بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ ما!' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $jobGrades = JobGrade::findOrFail($id);
            $jobGrades->delete();
            DB::commit();
            return redirect()->route('dashboard.jobGrades.index')->with('success', 'تم حذف الدرجه الوظيفية بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ ما!' . $ex->getMessage()])->withInput();
        }
    }

    public function checkjobGradeName(Request $request)
    {
        $checkExists = JobGrade::where('name', $request->name)->exists();

        return response()->json(['exists' => $checkExists]);
    }
}
