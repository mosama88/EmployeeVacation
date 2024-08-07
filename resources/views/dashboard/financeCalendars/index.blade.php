@extends('dashboard.layouts.master')
@section('title', 'السنوات المالية')
@section('css')
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--- sweetalert2 css -->
    <link href="{{ URL::asset('dashboard/assets/css/sweetalert2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    @include('dashboard.messages_alert')


    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">السنوات المالية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    جدول
                    السنوات المالية</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled"
                        data-toggle="modal" href="#modaldemo8"> <i class="fas fa-plus-circle"></i> أضافة سنه مالية جديدة</a>

                    @include('dashboard.financeCalendars.create')
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">جدول السنوات المالية</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">

                    </p>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-outline-danger mg-b-0 my-3" role="alert">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span></button>
                                <strong>حدث خطأ!</strong> {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <div class="table-responsive">
                        @if (@isset($data) && !@empty($data))
                            <table class="table text-md-nowrap" id="example2">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> #</th>
                                        <th class="wd-15p border-bottom-0"> أسم السنه المالية</th>
                                        <th class="wd-15p border-bottom-0"> ملاحظات</th>
                                        <th class="wd-15p border-bottom-0"> من</th>
                                        <th class="wd-15p border-bottom-0"> الى</th>
                                        <th class="wd-15p border-bottom-0"> الحالة</th>
                                        <th class="wd-10p border-bottom-0">الأضافة بواسطة</th>
                                        <th class="wd-25p border-bottom-0">التحديث بواسطة</th>
                                        <th class="wd-25p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data as $info)
                                        <?php $i++;
                                        $calcDays = \Carbon\Carbon::parse($info->from)->diffInDays(\Carbon\Carbon::parse($info->to)) + 1;
                                        ?>

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $info->finance_yr }}</td>
                                            <td>{{ $info->finance_yr_desc }}</td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>
                                                @if ($info->is_open == 1)
                                                    <span class="label text-success d-flex">
                                                        <div class="dot-label bg-success ml-1"></div>{{ __('نشط') }}
                                                    </span>
                                                @else
                                                    <span class="label text-danger d-flex">
                                                        <div class="dot-label bg-danger ml-1"></div>{{ __('غير نشط') }}
                                                    </span>
                                                @endif

                                            </td>
                                            <td>{{ $info->createdByAdmin->name }}</td>
                                            <td>
                                                @if ($info->updated_by > 0)
                                                    {{ $info->updatedByAdmin->name }}
                                                @else
                                                    <span class="text">لا يوجد</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Edit --}}
                                                <a class="modal-effect btn btn-outline-info btn-sm"
                                                    data-effect="effect-scale" data-toggle="modal"
                                                    href="#edit{{ $info->id }}"><i
                                                        class="fas fa-edit ml-1"></i>تعديل</a>

                                                {{-- Delete --}}
                                                <a class="modal-effect btn btn-outline-danger btn-sm"
                                                    data-effect="effect-scale" data-toggle="modal"
                                                    href="#delete{{ $info->id }}">
                                                    <i class="fas fa-trash-alt ml-1"></i>حذف</a>

                                            </td>
                                            @include('dashboard.financeCalendars.edit')
                                        </tr>
                                        @include('dashboard.financeCalendars.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning" role="alert" dir="rtl">
                                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                <span class="alert-inner--text"><strong> عفواً :</strong> لا توجد بيانات لعرضها!</span>
                            </div>
                        @endif

                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('dashboard/assets/js/modal.js') }}"></script>
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('dashboard/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('dashboard/assets/js/table-data.js') }}"></script>
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
    <script src="{{ URL::asset('dashboard/assets/js/projects/sweetalert2.min.js') }}"></script>



    <script>
        $(document).on('click', '#submit_financeCalendars', function(e) {
            e.preventDefault();

            var finance_yr = $("#finance_yr").val();
            var finance_yr_desc = $("#finance_yr_desc").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var form = $(this).closest('form'); // احفظ مرجع إلى النموذج

            // التحقق من السنه المالية
            if (finance_yr === "") {
                $('#modaldemo8').modal('hide'); // إخفاء الـ modal
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك أكتب السنه المالية',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show'); // إظهار الـ modal مرة أخرى
                });
                $("#finance_yr").focus();
                return false;
            }

            // التحقق من تفاصيل السنه المالية
            if (finance_yr_desc === "") {
                $('#modaldemo8').modal('hide'); // إخفاء الـ modal
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك أكتب  تفاصيل السنه المالية',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show'); // إظهار الـ modal مرة أخرى
                });
                $("#finance_yr_desc").focus();
                return false;
            }

            // التحقق من تاريخ البدء
            if (start_date === "") {
                $('#modaldemo8').modal('hide'); // إخفاء الـ modal
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك اختر تاريخ بداية السنه المالية',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show'); // إظهار الـ modal مرة أخرى
                });
                $("#start_date").focus();
                return false;
            }

            // التحقق من تاريخ الانتهاء
            if (end_date === "") {
                $('#modaldemo8').modal('hide'); // إخفاء الـ modal
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك اختر تاريخ نهاية السنه المالية',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show'); // إظهار الـ modal مرة أخرى
                });
                $("#end_date").focus();
                return false;
            }

            // التحقق من أن تاريخ الانتهاء هو بعد أو يساوي تاريخ البدء
            if (new Date(end_date) < new Date(start_date)) {
                $('#modaldemo8').modal('hide'); // إخفاء الـ modal
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'تاريخ الانتهاء يجب أن يكون بعد أو يساوي تاريخ البدء',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show'); // إظهار الـ modal مرة أخرى
                });
                $("#end_date").focus();
                return false;
            }

            // التحقق من وجود الاسم باستخدام AJAX قبل الإرسال
            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.financeCalendars.checkName') }}',
                data: {
                    finance_yr: finance_yr,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.exists) {
                        $('#modaldemo8').modal('hide'); // إخفاء الـ modal

                        Swal.fire({
                            icon: 'warning',
                            title: 'تحذير',
                            text: 'السنه المالية موجودة من قبل',
                            customClass: {
                                container: 'swal2-override'
                            }
                        }).then(() => {
                            $('#modaldemo8').modal('show'); // إظهار الـ modal بعد الضغط على OK
                            $("#name").focus();
                        });

                    } else {
                        // إرسال البيانات عبر AJAX بعد التحقق
                        $.ajax({
                            type: 'POST',
                            url: form.attr('action'), // استخدم المرجع إلى النموذج
                            data: form.serialize(),
                            success: function(data) {
                                $('#modaldemo8').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'عملية ناجحه',
                                    text: 'تم حفظ البيانات بنجاح',
                                    customClass: {
                                        container: 'swal2-override'
                                    }
                                }).then(() => {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error("XHR response:", xhr.responseText);
                                console.error("Status:", status);
                                console.error("Error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطأ',
                                    text: 'عفوا لقد حدث خطأ',
                                    customClass: {
                                        container: 'swal2-override'
                                    }
                                }).then(() => {
                                    $('#modaldemo8').modal('show');
                                });
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("XHR response:", xhr.responseText);
                    console.error("Status:", status);
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'عفوا لقد حدث خطأ',
                        customClass: {
                            container: 'swal2-override'
                        }
                    }).then(() => {
                        $('#modaldemo8').modal('show');
                    });
                }
            });
        });
    </script>






@endsection
