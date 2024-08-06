<!-- Scroll modal -->
<div class="modal" id="edit{{ $info->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل المسمى الوظيفى</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.jobCategories.update', $info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم المسمى الوظيفى</label>
                            <input type="text" name="name" id="name_edit" class="form-control"
                                value="{{ $info->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> الحالة</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected>-- أختر الحالة --</option>
                                <option @if ('status' == 1) selected @endif value="1">نشط</option>
                                <option @if ('status' == 2) selected @endif value="2">غير نشط
                                </option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">تأكيد البيانات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Scroll modal -->
