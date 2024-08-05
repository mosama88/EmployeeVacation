@extends('dashboard.layouts.master2')
@section('title', 'صفحة الدخول')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <style>
        .login-form {
            display: none;
        }

        .select-hide {

            margin-top: 100px;
        }
    </style>
@endsection
@section('content')
    <div class="col-12 container-fluid">
        <div class="row no-gutter">
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset('dashboard/assets/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                    </div>


                                    <div class="container select-hide">
                                        {{-- Select To login --}}
                                        <div class="row mb-3">
                                            <label class="form-label">حدد طريقة الدخول</label>
                                            <div class="col-sm-12">
                                                <select name="somename" class="form-control" id="selectForm"
                                                    aria-label="Default select example" onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')" tabindex="-1">
                                                    <option disabled selected="">
                                                        افتح قائمة التحديد</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger text-center">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endif

                                    {{-- Login Admin --}}
                                    <div class="login-form" id="admin">
                                        <h4 class="font-size-18 mt-5 text-center">
                                            مرحبًا بعودتك !
                                        </h4>
                                        <p class="text-muted text-center">الدخول بواسطة Admin
                                        </p>
                                        <form method="POST" action="">
                                            @csrf

                                            <!-- Email Input -->
                                            <div class="mb-3">
                                                <label class="form-label" for="username">أسم المستخدم</label>
                                                <input type="text" name="username" class="form-control" id="username"
                                                    placeholder="Enter username">
                                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                            </div>

                                            <!-- Password Input -->
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">كلمة المرور</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="userpassword" placeholder="Enter password">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="remember" class="form-check-input"
                                                            id="customControlInline">
                                                        <label class="form-check-label mx-3"
                                                            for="customControlInline">تذكرنى</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-center my-2">
                                                    <button class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit">دخول</button>
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-2 row">
                                                <div class="col-12 mt-3">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}"><i
                                                                class="mdi mdi-lock"></i>
                                                            نسيت كلمة المرور ؟
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </form>
                                    </div>


                                    {{-- Login User --}}
                                    <div class="login-form" id="user">
                                        <h4 class="font-size-18 mt-5 text-center">
                                            مرحبًا بعودتك !
                                        </h4>
                                        <p class="text-muted text-center">الدخول بواسطة User.
                                        </p>

                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <!-- Email Input -->
                                            <div class="mb-3">
                                                <label class="form-label" for="username">أسم المستخدم</label>
                                                <input type="text" name="email" class="form-control" id="username"
                                                    placeholder="Enter username">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>

                                            <!-- Password Input -->
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">كلمة المرور</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="userpassword" placeholder="Enter password">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="remember" class="form-check-input"
                                                            id="customControlInline">
                                                        <label class="form-check-label mx-3"
                                                            for="customControlInline">تذكرنى</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-center my-2">
                                                    <button class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit">دخول</button>
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-2 row">
                                                <div class="col-12 mt-3">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}"><i
                                                                class="mdi mdi-lock"></i>
                                                            نسيت كلمة المرور ؟
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->


            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex" style="background-color: #014051">
                <div class="row wd-110p">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('dashboard/assets/img/media/hr-system.jpg') }}" style="border-bottom-left-radius:15px;border-top-right-radius:15px;height:850px"
                            class=" my-auto ht-xl-80p wd-md-100p wd-xl-100p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            {{-- #0DB2DE --}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#selectForm').change(function() {
            var myID = $(this).val();
            $('.login-form').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}">
    </script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}">
    </script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('dashboard/assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('dashboard/assets/js/form-elements.js') }}"></script>
@endsection