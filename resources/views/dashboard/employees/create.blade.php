@extends('dashboard.layouts.master')
@section('title', 'أضافة موظف')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('dashboard/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet"
        type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('dashboard/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('dashboard/assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    أضافة موظف</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class=" btn btn-outline-primary" href="{{ route('dashboard.employees.index') }}"> <i
                            class="fas fa-undo"></i> الرجوع الى جدول الموظفين</a>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">أضافة موظف جديد</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('dashboard.employees.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_name">الأسم</label>
                                    <input type="text" name="name" id="employee_name" class="form-control"
                                        placeholder="الأسم" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_mobile">الموبايل</label>
                                    <input type="text" name="mobile"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" id="employee_mobile"
                                        class="form-control" placeholder="الموبايل" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Staies Address Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label>عنوان الاقامة </label>
                                    <input type="text" name="address" id="employee_address" placeholder="العنوان"
                                        class="form-control" value="{{ old('address') }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_appointment_id">الراحه الأسبوعية</label>
                                    <select multiple="multiple" name="appointment_id" id="employee_appointment_id"
                                        class="testselect2">
                                        <option selected value="volvo">Volvo</option>
                                        <option value="saab">Saab</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                    @error('appointment_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_email">البريد الالكترونى</label>
                                    <input type="email" name="email" id="employee_email" class="form-control"
                                        placeholder="البريد الالكترونى" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_password">كلمة المرور</label>
                                    <input type="password" name="password" id="employee_password" class="form-control"
                                        placeholder="كلمة المرور" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_birth_date">تاريخ الميلاد</label>
                                    <input type="date" name="birth_date" id="employee_birth_date" class="form-control"
                                        value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_hiring_date">تاريخ التعيين</label>
                                    <input type="date" name="hiring_date" id="employee_hiring_date"
                                        class="form-control" value="{{ old('hiring_date') }}">
                                    @error('hiring_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-3 col-4">
                                    <label for="employee_start_from">تاريخ التعيين بالأدارة | النيابة</label>
                                    <input type="date" name="start_from" id="employee_start_from"
                                        class="form-control" value="{{ old('start_from') }}">
                                    @error('start_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_add_service">أضافة سنوات الخدمه</label>
                                    <input type="text" name="add_service"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" id="employee_add_service"
                                        class="form-control" value="{{ old('add_service') }}">
                                    @error('add_service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_years_service">عدد سنوات الخدمه</label>
                                    <input type="text" name="years_service"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        id="employee_years_service" class="form-control"
                                        value="{{ old('years_service') }}">
                                    @error('years_service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_num_vacation_days">رصيد الأجازات</label>
                                    <input type="text" name="num_vacation_days"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        id="employee_num_vacation_days" class="form-control"
                                        value="{{ old('num_vacation_days') }}">
                                    @error('num_vacation_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label> نوع الجنس</label> <span class="tx-danger">*</span>
                                    <select name="gender" id="employee_gender" class="form-control">
                                        <option value="" selected>-- أختر النوع --</option>
                                        <option @if (old('gender') == '1') selected @endif value="Male">ذكر
                                        </option>
                                        <option @if (old('gender') == '2') selected @endif value="Female">انثي
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_governorate_id">المحافظة التابع لها</label>
                                    <select name="governorate_id" id="employee_governorate_id" class="select2">
                                        @foreach ($other['governorates'] as $info)
                                            <option selected value="">-- أختر المحافظة --</option>
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('governorate_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_city_id">المنطقه التابع لها</label>
                                    <select name="city_id" id="employee_city_id" class="select2">
                                        @foreach ($other['cities'] as $info)
                                            <option selected value="">-- أختر الدرجه المنطقه --</option>
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_branche_id">النيابة التابع لها</label>
                                    <select name="branche_id" id="employee_branche_id" class="select2">
                                        @foreach ($other['branches'] as $info)
                                            <option selected value="">-- أختر النيابة --</option>
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('branche_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_job_category_id">التخصص</label>
                                    <select name="job_category_id" id="employee_job_category_id" class="select2">
                                        @foreach ($other['job_categories'] as $info)
                                            <option selected value="">-- أختر التخصص --</option>
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('job_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-4">
                                    <label for="employee_job_grade_id">الدرجه الوظيفية</label>
                                    <select name="job_grade_id" id="employee_job_grade_id" class="select2">
                                        @foreach ($other['job_grades'] as $info)
                                            <option selected value="">-- أختر الدرجه الوظيفية --</option>
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('job_grade_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="employee_notes">ملاحظات</label>
                                    <textarea class="form-control" name="notes" id="employee_notes" placeholder="Textarea" rows="7">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-3 col-6">
                                    <label>الصورة الشخصية</label>
                                    <input type="file" name="photo" class="dropify" data-height="150" />
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">تأكيد البيانات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('dashboard/assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('dashboard/assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('dashboard/assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('dashboard/assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{ URL::asset('dashboard/assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>
@endsection
