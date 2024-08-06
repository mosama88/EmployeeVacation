<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\jobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\JobCategoryRequest;

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
    public function update(JobCategoryRequest $request, $id)
    {
        try {
            $chechExists = jobCategory::select("*")->where("name", $request->name)->first();
            if (!empty($chechExists) && $chechExists->status == $request->status) {
                return redirect()->back()->with(['error' => 'عفوآ أسم المسمى الوظيفى موجود من قبل!']);
            }
            DB::beginTransaction();
            $jobCategory = jobCategory::findOrFail($id);
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['status'] =  $request->status;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $jobCategory->update($dataToUpdate);

            DB::commit();
            return redirect()->route('dashboard.jobCategories.index')->with('success', 'تم تعديل المسمى الوظيفي بنجاح');
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
            $jobGrades = jobCategory::findOrFail($id);
            $jobGrades->delete();
            DB::commit();
            return redirect()->route('dashboard.jobCategories.index')->with('success', 'تم حذف المسمى الوظيفي بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ ما!' . $ex->getMessage()])->withInput();
        }
    }


    public function checkjobCategoryName(Request $request)
    {
        $checkExists = jobCategory::where('name', $request->name)->exists();

        return response()->json(['exists' => $checkExists]);
    }
}
