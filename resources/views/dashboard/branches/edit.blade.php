<!-- Scroll modal -->
<div class="modal" id="edit{{ $info->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضف نيابة | إدارة جديدة</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.branches.update', $info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم النيابة | الأدارة</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $info['name']) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> المحافظة</label>
                            <select name="governorate_id" id="governorate_id_edit" class="form-control">
                                <option value="" selected>-- أختر المحافظة --</option>
                                @if (@isset($other['governorates']) and !@empty($other['governorates']))
                                    @foreach ($other['governorates'] as $governorate)
                                        <option
                                            {{ old('governorate_id', $info['governorate_id']) == $governorate->id ? 'selected' : '' }}
                                            value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('governorate_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="submit_branch_edit" type="submit">تأكيد
                            البيانات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Scroll modal -->
