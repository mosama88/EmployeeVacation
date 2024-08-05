<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HolidayRequest;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Holiday::select("*")->orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.holidays.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $checkExists = Holiday::select("*")->where('name', $request->name)->first();
            if (!empty($checkExists)) {
                return redirect()->back()->with(['error' => 'عفوآ أسم العطلة موجود من قبل !']);
            }
            DB::beginTransaction();
            $dataToInsert = new Holiday();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['from'] = $request->from;
            $dataToInsert['to'] = $request->to;
            $dataToInsert['created_by'] = auth()->user()->id;

            $dataToInsert->save();
            DB::commit();
            return redirect()->route('dashboard.holidays.index')->with('success', 'تم أضافة العطلة بنجاح');
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
    public function edit(string $id)
    {
        return view('dashboard.holidays.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HolidayRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $holiday = Holiday::findOrFail($id);
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['from'] = $request->from;
            $dataToUpdate['to'] = $request->to;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $holiday->update($dataToUpdate);
            DB::commit();
            return redirect()->route('dashboard.holidays.index')->with('success', 'تم تعديل العطلة بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataDelete = Holiday::findOrFail($id);
            $dataDelete->delete();
            DB::commit();
            return redirect()->back()->with('success', 'تم حذف العطلة بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }
}
