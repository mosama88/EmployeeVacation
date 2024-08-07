@extends('dashboard.layouts.master')
@section('title', 'الأحياء')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
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
                <h4 class="content-title mb-0 my-auto">الأحياء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    جدول
                    الأحياء</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled"
                        data-toggle="modal" href="#modaldemo8"> <i class="fas fa-plus-circle"></i> أضافة حى جديد</a>

                    @include('dashboard.cities.create')
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
                        <h4 class="card-title mg-b-0">جدول الأحياء</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"></p>
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

                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">الحى</th>
                                        <th class="wd-20p border-bottom-0">المحافظة</th>
                                        <th class="wd-15p border-bottom-0">الأضافة بواسطة</th>
                                        <th class="wd-10p border-bottom-0">التحديث بواسطة</th>
                                        <th class="wd-25p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data as $info)
                                        <?php $i++; ?>

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->governorate->name }}</td>
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
                                                    data-effect="effect-slide-in-right" data-toggle="modal"
                                                    href="#edit{{ $info->id }}"><i class="fas fa-edit ml-1"></i>تعديل</a>

                                                {{-- Delete --}}
                                                <a class="modal-effect btn btn-outline-danger btn-sm"
                                                    data-effect="effect-scale" data-toggle="modal"
                                                    href="#delete{{ $info->id }}">
                                                    <i class="fas fa-trash-alt ml-1"></i>حذف</a>

                                            </td>
                                            @include('dashboard.cities.edit')
                                        </tr>
                                        @include('dashboard.cities.delete')
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
                </div>
            </div>
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
    <script src="{{ URL::asset('dashboard/assets/js/projects/sweetalert2.min.js') }}"></script>

    <!-- Internal Modal js-->
    <script src="{{ URL::asset('dashboard/assets/js/modal.js') }}"></script>



    <script>
        $(document).on('click', '#submit', function(e) {
            e.preventDefault();

            var name = $("#name").val();
            var governorate_id = $("#governorate_id").val();
            var form = $(this).closest('form'); // احفظ مرجع إلى النموذج

            // التحقق من الحي
            if (name === "") {
                $('#modaldemo8').modal('hide');
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك أكتب أسم الحى',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show');
                });
                $("#name").focus();
                return false;
            }

            // التحقق من المحافظة
            if (governorate_id === "") {
                $('#modaldemo8').modal('hide');
                Swal.fire({
                    icon: 'warning',
                    title: 'تحذير',
                    text: 'من فضلك اختر المحافظة',
                    customClass: {
                        container: 'swal2-override'
                    }
                }).then(() => {
                    $('#modaldemo8').modal('show');
                });
                $("#governorate_id").focus();
                return false;
            }

            // التحقق من وجود الاسم باستخدام AJAX قبل الإرسال
            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.cities.checkName') }}',
                data: {
                    name: name,
                    governorate_id: governorate_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.exists) {
                        $('#modaldemo8').modal('hide'); // إخفاء الـ modal

                        Swal.fire({
                            icon: 'warning',
                            title: 'تحذير',
                            text: 'اسم الحي موجود من قبل في نفس المحافظة',
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
