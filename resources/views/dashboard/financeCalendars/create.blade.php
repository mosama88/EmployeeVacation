<!-- Scroll modal -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضف سنه مالية جديدة</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.financeCalendars.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم السنه المالية</label>
                            <input type="text" name="finance_yr" id="finance_yr" class="form-control"
                                value="{{ old('finance_yr') }}">
                            @error('finance_yr')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> تفاصيل السنه المالية</label>
                            <textarea class="form-control" name="finance_yr_desc" id="finance_yr_desc" placeholder="تفاصيل" rows="3"></textarea>

                            @error('finance_yr_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> بداية السنه</label>
                            <input class="form-control fc-datepicker" name="start_date" id="start_date"
                                placeholder="MM/DD/YYYY" type="date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> نهاية السنه</label>
                            <input class="form-control fc-datepicker" name="end_date" id="end_date"
                                placeholder="MM/DD/YYYY" type="date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="submit_financeCalendars" type="submit">تأكيد
                            البيانات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Scroll modal -->
