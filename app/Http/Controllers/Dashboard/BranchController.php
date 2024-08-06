<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Branch;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branch::select("*")->orderBy("id", "DESC")->get();
        $other['governorates'] = Governorate::select("*")->get();
        return view('dashboard.branches.index', compact('data', 'other'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['governorates'] = Governorate::select("*")->get();
        return view('dashboard.branches.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $dataToInsert = new Branch();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['governorate_id'] = $request->governorate_id;
            $dataToInsert['created_by'] = auth()->user()->id;
            $dataToInsert->save();
            DB::commit();
            return redirect()->route('dashboard.branches.index')->with('success', 'تم أضافة النيابة بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ !' . $ex->getMessage()])->withInput();
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
        $other['governorates'] = Governorate::select("*")->get();
        return view('dashboard.branches.edit', compact('other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request,  $id)
    {
        try {
            $checkExists = Branch::where('name', $request->name)->first();

            if(!@empty($checkExists) && $checkExists->governorate_id == $request->governorate_id ){
                return redirect()->back()->with(['error' => 'عفوآ أسم النيابة أو الادارة موجود بالفعل فى نفس المحافظه!']);

            }
            DB::beginTransaction();
            $branch = Branch::findOrFail($id);
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['governorate_id'] = $request->governorate_id;
            $dataToUpdate['updated_by'] = auth()->user()->id;

            $branch->update($dataToUpdate);

            DB::commit();
            return redirect()->route('dashboard.branches.index')->with('success', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ بقد حدث خطآ ما!' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataDelete = Branch::findOrFail($id);
            $dataDelete->delete();
            DB::commit();
            return redirect()->back()->with('success', 'تم حذف النيابة بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function checkBranchName(Request $request)
    {
        // التحقق من وجود المدينة بنفس الاسم في نفس المحافظة
        $checkExists = Branch::where('name', $request->name)
            ->where('governorate_id', $request->governorate_id)
            ->exists();

        // إرجاع الاستجابة بتنسيق JSON
        return response()->json(['exists' => $checkExists]);
    }
}
