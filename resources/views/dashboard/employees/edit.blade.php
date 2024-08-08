@extends('dashboard.layouts.master')
@section('title', 'تعديل موظف')
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
                    تعديل موظف</span>
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
                    <h4 class="card-title mb-1">تعديل موظف جديد</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{ route('dashboard.employees.update', $info->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <div class="row">
                                {{-- Name Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_name">الأسم</label> <span class="tx-danger">*</span>
                                    <input type="text" name="name" id="employee_name" class="form-control"
                                        placeholder="الأسم" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Mobile Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_mobile">الموبايل</label> <span class="tx-danger">*</span>
                                    <input type="text" name="mobile"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" id="employee_mobile"
                                        class="form-control" placeholder="الموبايل" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Address Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label>عنوان الاقامة </label> <span class="tx-danger">*</span>
                                    <input type="text" name="address" id="employee_address" placeholder="العنوان"
                                        class="form-control" value="{{ old('address') }}">
                                    @error('address')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Appointment Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_appointment_id">الراحه الأسبوعية</label> <span
                                        class="tx-danger">*</span>
                                    <select multiple="multiple" name="appointment_id" id="employee_appointment_id"
                                        class="testselect2">
                                        <option disabled>-- أختر الراحه --</option>
                                        @if (isset($other['appointments']) && !empty($other['appointments']))
                                            @foreach ($other['appointments'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('appointment_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('appointment_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Email Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_username">أسم المستخدم</label>
                                    <input type="text" name="username" autocomplete="off" id="employee_username"
                                        class="form-control" placeholder="أسم المستخدم" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Password Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_password">كلمة المرور</label>
                                    <input type="password" name="password" autocomplete="off" id="employee_password"
                                        class="form-control" placeholder="كلمة المرور" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Birth Date Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_birth_date">تاريخ الميلاد</label> <span
                                        class="tx-danger">*</span>
                                    <input type="date" name="birth_date" id="employee_birth_date"
                                        class="form-control" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Hiring Date Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_hiring_date">تاريخ التعيين</label> <span
                                        class="tx-danger">*</span>
                                    <input type="date" name="hiring_date" id="employee_hiring_date"
                                        class="form-control" value="{{ old('hiring_date') }}">
                                    @error('hiring_date')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Start From Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_start_from">تاريخ التعيين بالأدارة | النيابة</label>
                                    <input type="date" name="start_from" id="employee_start_from"
                                        class="form-control" value="{{ old('start_from') }}">
                                    @error('start_from')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Add Service Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_add_service">أضافة سنوات الخدمه</label>
                                    <input type="text" name="add_service"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" id="employee_add_service"
                                        class="form-control" value="{{ old('add_service') }}">
                                    @error('add_service')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Years Service Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_years_service">عدد سنوات الخدمه</label> <span
                                        class="tx-danger">*</span>
                                    <input type="text" name="years_service"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        id="employee_years_service" class="form-control"
                                        value="{{ old('years_service') }}">
                                    @error('years_service')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Num Vacation Days Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_num_vacation_days">رصيد الأجازات</label> <span
                                        class="tx-danger">*</span>
                                    <input type="text" name="num_vacation_days"
                                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                                        id="employee_num_vacation_days" class="form-control"
                                        value="{{ old('num_vacation_days') }}">
                                    @error('num_vacation_days')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Gender Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label> نوع الجنس</label> <span class="tx-danger">*</span>
                                    <select name="gender" id="employee_gender" class="form-control">
                                        <option value="" selected>-- أختر النوع --</option>
                                        <option @if (old('gender') == 1) selected @endif value="1">ذكر
                                        </option>
                                        <option @if (old('gender') == 2) selected @endif value="2">انثي
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Governorate Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_governorate_id">المحافظة التابع لها</label> <span
                                        class="tx-danger">*</span>
                                    <select name="governorate_id" id="employee_governorate_id" class="select2">
                                        <option selected value="">-- أختر المحافظة --</option>
                                        @if (isset($other['governorates']) && !empty($other['governorates']))
                                            @foreach ($other['governorates'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('governorate_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('governorate_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- City Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_city_id">المنطقه التابع لها</label>
                                    <select name="city_id" id="employee_city_id" class="select2">
                                        <option selected value="">-- أختر الدرجه المنطقه --</option>
                                        @if (isset($other['cities']) && !empty($other['cities']))
                                            @foreach ($other['cities'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('city_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('city_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Branch Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_branche_id">النيابة التابع لها</label> <span
                                        class="tx-danger">*</span>
                                    <select name="branche_id" id="employee_branche_id" class="select2">
                                        <option selected value="">-- أختر النيابة --</option>
                                        @if (isset($other['branches']) && !empty($other['branches']))
                                            @foreach ($other['branches'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('branche_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('branche_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Job Category Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_job_category_id">التخصص</label> <span class="tx-danger">*</span>
                                    <select name="job_category_id" id="employee_job_category_id" class="select2">
                                        <option selected value="">-- أختر التخصص --</option>
                                        @if (isset($other['job_categories']) && !empty($other['job_categories']))
                                            @foreach ($other['job_categories'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('job_category_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('job_category_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Job Grade Input --}}
                                <div class="form-group mb-3 col-4">
                                    <label for="employee_job_grade_id">الدرجه الوظيفية</label> <span
                                        class="tx-danger">*</span>
                                    <select name="job_grade_id" id="employee_job_grade_id" class="select2">
                                        <option selected value="">-- أختر الدرجه الوظيفية --</option>
                                        @if (isset($other['job_grades']) && !empty($other['job_grades']))
                                            @foreach ($other['job_grades'] as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ old('job_grade_id') == $info->id ? 'selected' : '' }}>
                                                    {{ $info->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('job_grade_id')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Notes Input --}}
                                <div class="form-group mb-3 col-6">
                                    <label for="employee_notes">ملاحظات</label>
                                    <textarea class="form-control" name="notes" id="employee_notes" placeholder="Textarea" rows="7">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                {{-- Photo Input --}}
                                <div class="form-group mb-3 col-6">
                                    <label>الصورة الشخصية</label>
                                    <input type="file" name="photo" class="dropify" data-height="150" />
                                    @error('photo')
                                        <div class="alert alert-danger mb-0 mt-1" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                            <span class="alert-inner--text"><strong>خطأ!</strong> {{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">تعديل البيانات</button>
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
