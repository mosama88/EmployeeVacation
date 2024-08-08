@extends('dashboard.layouts.master')
@section('title', 'أضافة موظف')
@section('css')
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
                    <form>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputName">الأسم</label>
                                <input type="text" name="name" id="employee_name" class="form-control"
                                    id="exampleInputName" placeholder="الأسم">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">البريد الالكترونى</label>
                                <input type="email" name="email" id="employee_email" class="form-control"
                                    id="exampleInputEmail" placeholder="البريد الالكترونى">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">كلمة المرور</label>
                                <input type="password" name="password" id="employee_password" class="form-control"
                                    id="exampleInputPassword1" placeholder="كلمة المرور">
                            </div>
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                        id="checkbox-1">
                                    <label for="checkbox-1" class="custom-control-label mt-1">Check me Out</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
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
@endsection
