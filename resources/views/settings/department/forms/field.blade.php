<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label for="college_id" class="control-label col-md-2">{{ trans('college.colleges') }}</label>
                <div class="col-md-10">
                        <select id="college_id" class="select2 form-control custom-select {{$errors->has('college_id') ? 'is-invalid' : ''}}" style="width: 100%; height:36px;" name="college_id"
                                data-placeholder="{{trans('department.selectCollege')}}">
                        <option value="">{{trans('department.selectCollege')}}</option>
                        @foreach($data as $data1)
                            <option value="{{ $data1->id }}" {{old('college_id') == $data1->id || isset($department->college_id) && $department->college_id == $data1->id ? 'selected' : '' }}>{{ $data1->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('college_id'))
                        <small class="form-control-feedback text-danger"> {{ $errors->first('college_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.nameEn')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_en" name="name_en"
                           class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('common.nameEnLabel') }}"
                           value="{{ old('name_en', ($department->name_en ?? '')) }}">
                    @if ($errors->has('name_en'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('name_en')}}</strong>
                       </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">{{trans('common.nameAr')}}</label>
                <div class="col-md-10">
                    <input type="text" id="name_ar" name="name_ar"
                           class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                           placeholder="{{ trans('common.nameArLabel') }}"
                           value="{{ old('name_ar', ($department->name_ar ?? '')) }}">
                    @if ($errors->has('name_ar'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('name_ar') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit"
                            class="btn btn-linkedin">{{empty($department->id) ? trans('common.save') : trans('common.update')}}</button>
                    <a href="{{route('department.index')}}"
                       class="btn btn-danger"> {{trans('common.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // For select 2
            $(".select2").select2();
        });
    </script>
@endpush