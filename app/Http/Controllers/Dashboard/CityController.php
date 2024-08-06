<?php

namespace App\Http\Controllers\Dashboard;

use auth;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $other['governorates'] = Governorate::get();
        $data = City::select("*")->orderBy('id', 'DESC')->get();

        return view('dashboard.cities.index', compact('data', 'other'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['governorates'] = Governorate::get();
        return view('dashboard.cities.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $checkExists = City::where('name', $request->name)->first();

            if (!empty($checkExists) && $checkExists->governorate_id == $request->governorate_id) {
                return redirect()->back()->with(['error' => 'أسم الحى موجود من قبل في نفس المحافظة!'])->withInput();
            }

            DB::beginTransaction();
            $dataToInsert = new City();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['governorate_id'] = $request->governorate_id;
            $dataToInsert['created_by'] = auth()->user()->id;

            $dataToInsert->save();
            DB::commit();
            return response()->json(['success' => 'تم أضافة الحى بنجاح']);
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
    public function edit(string $id)
    {
        $other['governorates'] = Governorate::get();
        return view('dashboard.cities.edit', compact('other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $id)
    {
        try {
            $checkExists = City::where('name', $request->name)->first();

            if (!empty($checkExists) && $checkExists->governorate_id == $request->governorate_id) {
                return redirect()->back()->with(['error' => 'أسم الحى موجود من قبل في نفس المحافظة!'])->withInput();
            }

            DB::beginTransaction();
            $city = City::findOrFail($id);
            $dataToUpdate['name'] = $request->name;
            $dataToUpdate['governorate_id'] = $request->governorate_id;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $city->update($dataToUpdate);
            DB::commit();
            return redirect()->route('dashboard.cities.index')->with('success', 'تم تعديل الحى بنجاح');
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
            $dataDelete = City::findOrFail($id);
            $dataDelete->delete();
            DB::commit();
            return redirect()->back()->with('success', 'تم حذف الحى بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }



    public function checkCityName(Request $request)
    {
        // التحقق من وجود المدينة بنفس الاسم في نفس المحافظة
        $checkExists = City::where('name', $request->name)
            ->where('governorate_id', $request->governorate_id)
            ->exists();

        // إرجاع الاستجابة بتنسيق JSON
        return response()->json(['exists' => $checkExists]);
    }
}
