<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FinanceCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FinanceCalendar::select("*")->orderBy('id', 'DESC')->get();
        return view('dashboard.financeCalendars.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.financeCalendars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $financeCalendar = new FinanceCalendar();
            $financeCalendar['finance_yr'] = $request->finance_yr;
            $financeCalendar['finance_yr_desc'] = $request->finance_yr_desc;
            $financeCalendar['start_date'] = $request->start_date;
            $financeCalendar['end_date'] = $request->end_date;
            $financeCalendar['is_open'] = 1;
            $financeCalendar['created_by'] = auth()->user()->id;
            $financeClnPeriod = $financeCalendar->save();

            DB::commit();
            return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم أضافة السنه المالية بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ !' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.financeCalendars.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            DB::beginTransaction();

            $financeCalendars = FinanceCalendar::findOrFail($id);
            $financeCalendar['finance_yr'] = $request->finance_yr;
            $financeCalendar['finance_yr_desc'] = $request->finance_yr_desc;
            $financeCalendar['start_date'] = $request->start_date;
            $financeCalendar['end_date'] = $request->end_date;
            $financeCalendar['is_open'] = $request->is_open;
            $financeCalendar['updated_by'] = auth()->user()->id;
            $financeCalendars->update($financeCalendar);

            DB::commit();
            return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم تعديل السنه المالية بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوآ لقد حدث خطأ !' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataDelete = FinanceCalendar::findOrFail($id);
            $dataDelete->delete();
            DB::commit();
            return redirect()->back()->with('success', 'تم حذف السنه المالية بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }


    public function checkFinanceCalendarsName(Request $request)
    {
        $checkExists = FinanceCalendar::where('finance_yr', $request->finance_yr)->exists();

        return response()->json(['exists' => $checkExists]);
    }
}
