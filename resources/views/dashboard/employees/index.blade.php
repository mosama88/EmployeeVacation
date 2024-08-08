@extends('dashboard.layouts.master')
@section('title', 'الموظفين')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    @include('dashboard.messages_alert')


    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    جدول
                    الموظفين</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="modal-effect btn btn-outline-primary btn-block"
                        href="{{ route('dashboard.employees.create') }}"> <i class="fas fa-plus-circle"></i> أضافة موظف
                        جديد</a>
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
                        <h4 class="card-title mg-b-0">جدول الموظفين</h4>
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
                                        <th class="wd-15p border-bottom-0"> الصورة</th>
                                        <th class="wd-15p border-bottom-0"> الأسم</th>
                                        <th class="wd-15p border-bottom-0"> الموبايل</th>
                                        <th class="wd-15p border-bottom-0"> تاريخ التعيين</th>
                                        <th class="wd-15p border-bottom-0"> رصيد الأجازات</th>
                                        <th class="wd-15p border-bottom-0"> الراحه الاسبوعيه</th>
                                        <th class="wd-15p border-bottom-0"> محافظة</th>
                                        <th class="wd-25p border-bottom-0">تاريخ التعيين</th>
                                        <th class="wd-10p border-bottom-0">الأضافة بواسطة</th>
                                        <th class="wd-25p border-bottom-0">التحديث بواسطة</th>
                                        <th class="wd-25p border-bottom-0">الحالة</th>
                                        <th class="wd-25p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data as $info)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                @if ($info->image)
                                                    <img class="img-thumbnail rounded me-2" alt="200x200"
                                                        style="width: 80px; height:50px"
                                                        src="{{ asset('dashboard/assets/images/uploads/employees/' . $info->image->filename) }}"
                                                        data-holder-rendered="true">
                                                @elseif ($info->gender == 1)
                                                    <img alt="Responsive image" class="img-thumbnail rounded me-2"
                                                        alt="200x200" style="width: 80px; height:50px"
                                                        src="{{ asset('dashboard/assets/img/employees-default.png') }}">
                                                @else
                                                    <img alt="Responsive image" style="width: 80px; height:50px"
                                                        src="{{ asset('dashboard/assets/img/employees-female-default.png') }}">
                                                @endif
                                            </td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->mobile }}</td>
                                            <td>{{ $info->hiring_date }}</td>
                                            <td>{{ $info->num_vacation_days }}</td>
                                            <td>{{ $info->appointment->name }}</td>
                                            <td>{{ $info->governorate->name }}</td>
                                            <td>{{ $info->hiring_date }}</td>
                                            <td>{{ $info->createdByAdmin->name }}</td>
                                            <td>
                                                @if ($info->updated_by > 0)
                                                    {{ $info->updatedByAdmin->name }}
                                                @else
                                                    <span class="text">لا يوجد</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($info->status == 1)
                                                    <span class="label text-success">
                                                        <div class="dot-label bg-success ml-1"></div>
                                                        {{ __('مفعل') }}
                                                    </span>
                                                @elseif ($info->status == 2)
                                                    <span class="label text-danger">
                                                        <div class="dot-label bg-danger ml-1"></div>{{ __('غير مفعل') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Show --}}
                                                <a class="modal-effect btn btn-outline-primary btn-sm"
                                                    href="{{ route('dashboard.employees.show', $info->id) }}"><i
                                                        class="fas fa-edit ml-1"></i>عرض
                                                    البيانات</a>

                                                {{-- Edit --}}
                                                <a class="modal-effect btn btn-outline-info btn-sm"
                                                    href="{{ route('dashboard.employees.edit', $info->id) }}"><i
                                                        class="fas fa-edit ml-1"></i>تعديل</a>

                                                {{-- Delete --}}
                                                <a class="modal-effect btn btn-outline-danger btn-sm"
                                                    data-effect="effect-scale" data-toggle="modal"
                                                    href="#delete{{ $info->id }}">
                                                    <i class="fas fa-trash-alt ml-1"></i>حذف</a>
                                            </td>
                                        </tr>
                                        @include('dashboard.employees.delete')
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
@endsection
