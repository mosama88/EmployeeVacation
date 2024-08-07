<!-- Scroll modal -->
<div class="modal" id="edit{{ $info->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل السنه المالية</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.financeCalendars.update', $info->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم السنه المالية</label>
                            <input type="text" name="finance_yr" id="finance_yr" class="form-control"
                                value="{{ old('finance_yr', $info->finance_yr) }}">
                            @error('finance_yr')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم السنه المالية</label>
                            <textarea class="form-control" name="finance_yr_desc" id="finance_yr_desc" placeholder="تفاصيل" rows="3">{{ old('finance_yr', $info->finance_yr) }}
                            </textarea>

                            @error('finance_yr_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> من يوم</label>
                            <input class="form-control fc-datepicker" name="start_date" id="start_date"
                                placeholder="MM/DD/YYYY" type="date"
                                value="{{ old('start_date', $info->start_date) }}">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> إلى يوم</label>
                            <input class="form-control fc-datepicker" name="end_date" id="end_date"
                                placeholder="MM/DD/YYYY" type="date" value="{{ old('end_date', $info->end_date) }}">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> الحالة</label>
                            <select name="is_open" id="is_open" class="form-control">
                                <option value="" selected>-- أختر الحالة --</option>
                                <option @if ($info->is_open == 1) selected @endif value="1">نشط</option>
                                <option @if ($info->is_open == 2) selected @endif value="2">غير نشط
                                </option>
                            </select>
                            @error('is_open')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="submit" type="submit">تأكيد البيانات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Scroll modal -->
