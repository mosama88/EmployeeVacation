<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Month;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriods;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FinanceCalendarRequest;

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

    public function store(FinanceCalendarRequest $request)
    {


        $FinanceCalendar = new FinanceCalendar();
        $FinanceCalendar->finance_yr = $request->finance_yr;
        $FinanceCalendar->finance_yr_desc = $request->finance_yr_desc;
        $FinanceCalendar->start_date = $request->start_date;
        $FinanceCalendar->end_date = $request->end_date;
        $FinanceCalendar->created_by = auth()->user()->id;
        $FinanceCalendar->is_open = 0;
        $financeClnPeriod = $FinanceCalendar->save();

        if ($financeClnPeriod) {
            $insertdataOfFinanceCalendar = FinanceCalendar::select('id', 'finance_yr')->where('id', $FinanceCalendar->id)->first();

            $startDate = new DateTime($request->start_date);
            $endDate = new DateTime($request->end_date);
            $endDate->modify('first day of next month'); // To include the end date month in the period
            $dateInterval = new DateInterval('P1M'); // P1M = Period of 1 Month
            $datePeriod = new DatePeriod($startDate, $dateInterval, $endDate);

            foreach ($datePeriod as $date) {
                $dataMonth = [];
                $dataMonth['finance_calendars_id'] = $insertdataOfFinanceCalendar->id;

                $MonthName_en = $date->format('F'); // 'F': Full month name in English
                $dataParentMonth = Month::select("id")->where('name_en', $MonthName_en)->first();
                $dataMonth['month_id'] = $dataParentMonth ? $dataParentMonth->id : null;
                $dataMonth['finance_yr'] = $insertdataOfFinanceCalendar->finance_yr;
                $dataMonth['start_date_month'] = $date->format('Y-m-01');
                $dataMonth['end_date_month'] = $date->format('Y-m-t');
                $dataMonth['year_and_month'] = $date->format('Y-m');
                $CalcnumOfDays = strtotime($dataMonth['end_date_month']) - strtotime($dataMonth['start_date_month']);
                $dataMonth['number_of_days'] = round($CalcnumOfDays / (60 * 60 * 24)) + 1;
                $dataMonth['updated_at'] = now();
                $dataMonth['created_at'] = now();
                $dataMonth['created_by'] = auth()->user()->id;
                $dataMonth['updated_by'] = auth()->user()->id;
                $dataMonth['start_date_fp'] = $dataMonth['start_date_month'];
                $dataMonth['end_date_fp'] = $dataMonth['end_date_month'];
                FinanceClnPeriods::insert($dataMonth);
            }
        }
        session()->flash('success', 'تم أضافة البيانات بنجاح');
        return redirect()->route('dashboard.financeCalendars.index');
    }




    /**
     * Display the specified resource.
     */
  
     public function show(Request $request, $id)
     {
         // استرجاع مجموعة من السجلات بناءً على finance_calendars_id
         $finance_cln_periods = FinanceClnPeriods::where('finance_calendars_id', $id)->get();
 
         // تمرير البيانات إلى العرض
         return view("dashboard.financeCalendars.show", ['finance_cln_periods' => $finance_cln_periods]);
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

    public function editISOpen(Request $request, $id)
    {
        // البحث عن السجل الحالي باستخدام المعرف (ID)
        $finance_cln_period = FinanceClnPeriods::findOrFail($id);
        
        // تحديث الحالة
        $finance_cln_period->is_open = $request->input('is_open');
        
        // حفظ التحديثات
        $finance_cln_period->save();
    
        // إعادة التوجيه إلى الصفحة السابقة مع رسالة نجاح
        return redirect()->back()->with('success', 'تم تعديل الشهر المالي بنجاح');
    }
    
}

        //P = Period: يشير إلى "فترة" (Period). يستخدم دائمًا في بداية سلسلة DateInterval للإشارة إلى أن ما يلي هو وصف لفترة زمنية.
                // 1M = 1 Month: يشير إلى "شهر واحد" (1 Month).

                
// 'Y': يعيد السنة بأربع أرقام (مثل: 2024).
// 'm': يعيد رقم الشهر برقمين (مثل: 08).
// 'd': يعيد رقم اليوم برقمين (مثل: 07).

// F: هو حرف تنسيق (Format Character) في PHP يستخدم لإخراج الاسم الكامل للشهر باللغة الإنجليزية.